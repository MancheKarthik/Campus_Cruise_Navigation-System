// netlify/functions/login.js
const { Client } = require('pg');

exports.handler = async (event) => {
  const { email, passwd } = JSON.parse(event.body || '{}');

  const client = new Client({
    connectionString: process.env.DATABASE_URL, // Use Neon DB connection URL
    ssl: { rejectUnauthorized: false }
  });

  try {
    await client.connect();
    const result = await client.query('SELECT * FROM userinfo WHERE email = $1 AND password = $2', [email, passwd]);

    if (result.rows.length > 0) {
      return {
        statusCode: 200,
        body: JSON.stringify({ success: true, message: 'Login successful' })
      };
    } else {
      return {
        statusCode: 401,
        body: JSON.stringify({ success: false, message: 'Invalid credentials' })
      };
    }
  } catch (err) {
    console.error('Database error:', err);
    return {
      statusCode: 500,
      body: JSON.stringify({ success: false, message: 'Server error' })
    };
  } finally {
    await client.end();
  }
};
