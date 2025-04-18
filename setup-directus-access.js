require('dotenv').config({ path: './magellan/.env' });
const axios = require('axios');

// Get environment variables with fallbacks
// Use localhost:8055 for direct access, ignoring env variable
const DIRECTUS_URL = 'http://localhost:8055';
const ADMIN_EMAIL = process.env.DIRECTUS_ADMIN_EMAIL || 'admin@example.com';
const ADMIN_PASSWORD = process.env.DIRECTUS_ADMIN_PASSWORD || 'admin';
const PUBLIC_TOKEN_NAME = 'public_access_token';

// Log configuration
console.log(`Using Directus URL: ${DIRECTUS_URL}`);

// Get admin token for authentication
async function getAdminToken() {
  console.log('Logging in as admin...');
  try {
    const response = await axios.post(`${DIRECTUS_URL}/auth/login`, {
      email: ADMIN_EMAIL,
      password: ADMIN_PASSWORD
    });
    return response.data.data.access_token;
  } catch (error) {
    console.error('Admin login failed:', error.message);
    throw new Error('Failed to get admin token');
  }
}

// Create static token for public access
async function createStaticToken(adminToken) {
  console.log('Checking for existing public access token...');
  try {
    // Check if token already exists
    const existingTokens = await axios.get(`${DIRECTUS_URL}/users/me/tokens`, {
      headers: { Authorization: `Bearer ${adminToken}` }
    });
    
    const publicToken = existingTokens.data.data.find(token => token.name === PUBLIC_TOKEN_NAME);
    
    if (publicToken) {
      console.log('Public access token already exists');
      return publicToken.token;
    }
    
    console.log('Creating new public access token...');
    const response = await axios.post(`${DIRECTUS_URL}/users/me/tokens`, {
      name: PUBLIC_TOKEN_NAME
    }, {
      headers: { Authorization: `Bearer ${adminToken}` }
    });
    
    console.log('Public access token created successfully');
    return response.data.data.token;
  } catch (error) {
    console.error('Failed to create static token:', error.message);
    throw new Error('Failed to create static token');
  }
}

// Set up permissions for public access
async function setPermissions(adminToken, collection) {
  console.log(`Setting permissions for ${collection}...`);
  try {
    // Check if permissions already exist
    const existingPermissions = await axios.get(`${DIRECTUS_URL}/permissions`, {
      headers: { Authorization: `Bearer ${adminToken}` }
    });
    
    const hasPermission = existingPermissions.data.data.some(perm => 
      perm.collection === collection && perm.action === 'read' && perm.role === null
    );
    
    if (hasPermission) {
      console.log(`Permissions for ${collection} already exist`);
      return;
    }
    
    // Create new permission
    await axios.post(`${DIRECTUS_URL}/permissions`, {
      collection,
      action: 'read',
      role: null,
      fields: '*'
    }, {
      headers: { Authorization: `Bearer ${adminToken}` }
    });
    
    console.log(`Permissions for ${collection} set successfully`);
  } catch (error) {
    console.error(`Failed to set permissions for ${collection}:`, error.message);
    throw new Error(`Failed to set permissions for ${collection}`);
  }
}

// Main function to run the setup
async function main() {
  try {
    // Get admin token
    const adminToken = await getAdminToken();
    console.log('Admin login successful');
    
    // Create static token
    const staticToken = await createStaticToken(adminToken);
    console.log(`Static token: ${staticToken}`);
    console.log('Use this token in your DIRECTUS_API_TOKEN environment variable');
    
    // Set permissions for articles collection
    await setPermissions(adminToken, 'articles');
    
    console.log('Setup completed successfully');
  } catch (error) {
    console.error(`Setup failed: ${error.message}`);
    process.exit(1);
  }
}

// Run the setup
main(); 