// Script to set up the necessary collections in Directus
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

    // 2. Create categories collection
    console.log('\nCreating categories collection...');
    await axios.post(
      'http://localhost:8055/collections',
      {
        collection: 'categories',
        fields: [
          {
            field: 'id',
            type: 'integer',
            meta: {
              special: ['uuid'],
              interface: 'input',
              readonly: true,
              hidden: true,
              width: 'full',
              sort: 1,
              required: true
            },
            schema: {
              is_primary_key: true,
              has_auto_increment: false
            }
          },
          {
            field: 'name',
            type: 'string',
            meta: {
              interface: 'input',
              width: 'full',
              sort: 2,
              required: true
            },
            schema: {
              is_nullable: false
            }
          },
          {
            field: 'color',
            type: 'string',
            meta: {
              interface: 'select-color',
              width: 'full',
              sort: 3
            }
          }
        ],
        meta: {
          singleton: false,
          icon: 'folder'
        },
        schema: {}
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );
    console.log('Categories collection created');

    // 3. Create authors collection
    console.log('\nCreating authors collection...');
    await axios.post(
      'http://localhost:8055/collections',
      {
        collection: 'authors',
        fields: [
          {
            field: 'id',
            type: 'integer',
            meta: {
              special: ['uuid'],
              interface: 'input',
              readonly: true,
              hidden: true,
              width: 'full',
              sort: 1,
              required: true
            },
            schema: {
              is_primary_key: true,
              has_auto_increment: false
            }
          },
          {
            field: 'first_name',
            type: 'string',
            meta: {
              interface: 'input',
              width: 'half',
              sort: 2,
              required: true
            },
            schema: {
              is_nullable: false
            }
          },
          {
            field: 'last_name',
            type: 'string',
            meta: {
              interface: 'input',
              width: 'half',
              sort: 3,
              required: true
            },
            schema: {
              is_nullable: false
            }
          },
          {
            field: 'avatar',
            type: 'uuid',
            meta: {
              interface: 'file-image',
              special: ['file'],
              width: 'full',
              sort: 4
            },
            schema: {
              is_nullable: true
            }
          }
        ],
        meta: {
          singleton: false,
          icon: 'person'
        },
        schema: {}
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );
    console.log('Authors collection created');

    // 4. Create articles collection
    console.log('\nCreating articles collection...');
    await axios.post(
      'http://localhost:8055/collections',
      {
        collection: 'articles',
        fields: [
          {
            field: 'id',
            type: 'uuid',
            meta: {
              special: ['uuid'],
              interface: 'input',
              readonly: true,
              hidden: true,
              width: 'full',
              sort: 1,
              required: true
            },
            schema: {
              is_primary_key: true,
              has_auto_increment: false
            }
          },
          {
            field: 'title',
            type: 'string',
            meta: {
              interface: 'input',
              width: 'full',
              sort: 2,
              required: true
            },
            schema: {
              is_nullable: false
            }
          },
          {
            field: 'content',
            type: 'text',
            meta: {
              interface: 'input-rich-text-html',
              width: 'full',
              sort: 3,
              required: true
            },
            schema: {
              is_nullable: false
            }
          },
          {
            field: 'featured_image',
            type: 'uuid',
            meta: {
              interface: 'file-image',
              special: ['file'],
              width: 'full',
              sort: 4
            },
            schema: {
              is_nullable: true
            }
          },
          {
            field: 'date_created',
            type: 'timestamp',
            meta: {
              special: ['date-created'],
              interface: 'datetime',
              readonly: true,
              width: 'half',
              sort: 5,
              required: true
            },
            schema: {
              is_nullable: false,
              default_value: 'now()'
            }
          },
          {
            field: 'category',
            type: 'integer',
            meta: {
              interface: 'select-dropdown-m2o',
              special: ['m2o'],
              width: 'half',
              sort: 6,
              required: true
            },
            schema: {
              is_nullable: false,
              foreign_key_table: 'categories',
              foreign_key_column: 'id'
            }
          },
          {
            field: 'author',
            type: 'integer',
            meta: {
              interface: 'select-dropdown-m2o',
              special: ['m2o'],
              width: 'half',
              sort: 7,
              required: true
            },
            schema: {
              is_nullable: false,
              foreign_key_table: 'authors',
              foreign_key_column: 'id'
            }
          }
        ],
        meta: {
          singleton: false,
          icon: 'article'
        },
        schema: {}
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );
    console.log('Articles collection created');

    // 5. Create some sample data - categories
    console.log('\nCreating sample categories...');
    const categories = [
      { name: 'News', color: '#3B82F6' },
      { name: 'Discovery', color: '#10B981' },
      { name: 'Aviation', color: '#F59E0B' },
      { name: 'Finance', color: '#6366F1' },
      { name: 'History', color: '#EC4899' }
    ];

    for (const category of categories) {
      await axios.post(
        'http://localhost:8055/items/categories',
        category,
        {
          headers: {
            Authorization: `Bearer ${accessToken}`
          }
        }
      );
    }
    console.log('Sample categories created');

    // 6. Create a sample author
    console.log('\nCreating a sample author...');
    const authorResponse = await axios.post(
      'http://localhost:8055/items/authors',
      {
        first_name: 'John',
        last_name: 'Doe'
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );
    
    const authorId = authorResponse.data.data.id;
    console.log('Sample author created with ID:', authorId);

    // 7. Create a sample article
    console.log('\nCreating a sample article...');
    await axios.post(
      'http://localhost:8055/items/articles',
      {
        title: 'Welcome to Logosorthos',
        content: '<p>This is a sample article to get you started with Logosorthos.</p>',
        category: 1, // News
        author: authorId
      },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`
        }
      }
    );
    console.log('Sample article created');

    console.log('\nSetup complete! You can now log in to Directus and see the collections and sample data.');

  } catch (error) {
    console.error('Error:', error.response?.data || error.message);
  }
}

setupDirectus(); 