// Script to set up public access in Directus
const axios = require('axios');

async function setupDirectus() {
  try {
    // 1. Login as admin
    console.log('Logging in to Directus...');
    const loginResponse = await axios.post('http://localhost:8055/auth/login', {
      email: 'justinzjones@hotmail.com',
      password: 'P8k#mN9@jX5'
    });

    const accessToken = loginResponse.data.data.access_token;
    console.log('Successfully logged in');

    // 2. Create a static API token
    console.log('Creating API token...');
    const tokenResponse = await axios.post(
      'http://localhost:8055/items/directus_users_tokens',
      {
        name: 'Public API Token',
        token: 'public_access_token', // Custom token
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );

    console.log('API token created successfully');
    console.log('Token: public_access_token');
    
    // 3. Create a public role
    console.log('\nCreating public role...');
    const roleResponse = await axios.post(
      'http://localhost:8055/items/directus_roles',
      {
        name: 'Public',
        app_access: false,
        enforce_tfa: false,
        admin_access: false,
        ip_access: null
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );

    const publicRoleId = roleResponse.data.data.id;
    console.log('Public role created with ID:', publicRoleId);

    // 4. Set permissions for articles collection
    console.log('\nSetting permissions for articles collection...');
    await axios.post(
      'http://localhost:8055/items/directus_permissions',
      {
        role: publicRoleId,
        collection: 'articles',
        action: 'read',
        permissions: {},
        fields: ['*']
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );

    console.log('Permissions set for articles collection');
    
    console.log('\nAdd the following line to your .env file:');
    console.log(`DIRECTUS_PUBLIC_TOKEN=public_access_token`);
    
    console.log('\nUpdate your ArticleController.php to use this token in all HTTP requests.');

  } catch (error) {
    console.error('Error:', error.response?.data || error.message);
  }
}

setupDirectus(); 