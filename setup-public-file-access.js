// Script to enable public access to file assets in Directus
const axios = require('axios');

async function setupDirectus() {
  try {
    // 1. Login as admin
    console.log('Logging in to Directus...');
    const loginResponse = await axios.post('http://localhost:8055/auth/login', {
      email: 'justinzjones@hotmail.com',
      password: 'Pass123!'
    });

    const accessToken = loginResponse.data.data.access_token;
    console.log('Successfully logged in');

    // 2. Create a public role if it doesn't exist
    console.log('\nCreating public role...');
    let publicRoleId;
    
    try {
      // Try to find existing public role
      const rolesResponse = await axios.get(
        'http://localhost:8055/roles?filter[name][_eq]=Public',
        {
          headers: {
            Authorization: `Bearer ${accessToken}`
          }
        }
      );
      
      if (rolesResponse.data.data && rolesResponse.data.data.length > 0) {
        publicRoleId = rolesResponse.data.data[0].id;
        console.log('Found existing public role with ID:', publicRoleId);
      } else {
        // Create a new public role
        const createRoleResponse = await axios.post(
          'http://localhost:8055/roles',
          {
            name: 'Public',
            app_access: false,
            admin_access: false,
            ip_access: null
          },
          {
            headers: {
              Authorization: `Bearer ${accessToken}`
            }
          }
        );
        
        publicRoleId = createRoleResponse.data.data.id;
        console.log('Created new public role with ID:', publicRoleId);
      }
    } catch (error) {
      console.error('Error creating/finding public role:', error.response?.data || error.message);
      return;
    }

    // 3. Set up permissions for directus_files collection for public role
    console.log('\nSetting permissions for directus_files collection...');
    try {
      await axios.post(
        'http://localhost:8055/permissions',
        {
          collection: 'directus_files',
          action: 'read',
          role: publicRoleId,
          fields: ['*']
        },
        {
          headers: {
            Authorization: `Bearer ${accessToken}`
          }
        }
      );
      console.log('Set read permissions for directus_files collection');
    } catch (error) {
      if (error.response?.data?.errors?.[0]?.extensions?.code === 'RECORD_NOT_UNIQUE') {
        console.log('File permissions already exist, updating...');
        
        // Get existing permission ID
        const permissionsResponse = await axios.get(
          `http://localhost:8055/permissions?filter[collection][_eq]=directus_files&filter[role][_eq]=${publicRoleId}&filter[action][_eq]=read`,
          {
            headers: {
              Authorization: `Bearer ${accessToken}`
            }
          }
        );
        
        if (permissionsResponse.data.data && permissionsResponse.data.data.length > 0) {
          const permissionId = permissionsResponse.data.data[0].id;
          
          // Update existing permission
          await axios.patch(
            `http://localhost:8055/permissions/${permissionId}`,
            {
              fields: ['*']
            },
            {
              headers: {
                Authorization: `Bearer ${accessToken}`
              }
            }
          );
          console.log('Updated existing file permissions');
        }
      } else {
        console.error('Error setting file permissions:', error.response?.data || error.message);
        return;
      }
    }

    // 4. Configure the storage settings to allow public read access
    console.log('\nUpdating storage settings...');
    try {
      await axios.patch(
        'http://localhost:8055/settings',
        {
          storage_asset_transform: 'all',
          storage_asset_presets: [
            {
              key: 'thumbnail',
              fit: 'cover',
              width: 200,
              height: 200,
              quality: 80
            },
            {
              key: 'medium',
              fit: 'contain',
              width: 500,
              height: 500,
              quality: 90
            },
            {
              key: 'large',
              fit: 'contain',
              width: 1000,
              height: 1000,
              quality: 90
            }
          ]
        },
        {
          headers: {
            Authorization: `Bearer ${accessToken}`
          }
        }
      );
      console.log('Updated storage settings');
    } catch (error) {
      console.error('Error updating storage settings:', error.response?.data || error.message);
    }

    console.log('\nSetup complete! Public file access should now be working.');
    console.log('Please restart the Directus container to apply all changes.');

  } catch (error) {
    console.error('Error:', error.response?.data || error.message);
  }
}

setupDirectus(); 