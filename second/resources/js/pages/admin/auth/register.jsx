import React from 'react';
import { useForm } from '@inertiajs/react';

export default function AdminRegister() {
  const { data, setData, post, processing, errors } = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('admin.register'));
  };

  return (
    <div style={{ maxWidth: 400, margin: 'auto', padding: 32 }}>
      <h1>Admin Register</h1>
      <form onSubmit={handleSubmit}>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="name">Name:</label>
          <input
            id="name"
            type="text"
            value={data.name}
            onChange={e => setData('name', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.name && <div style={{ color: 'red' }}>{errors.name}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="email">Email:</label>
          <input
            id="email"
            type="email"
            value={data.email}
            onChange={e => setData('email', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.email && <div style={{ color: 'red' }}>{errors.email}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="password">Password:</label>
          <input
            id="password"
            type="password"
            value={data.password}
            onChange={e => setData('password', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.password && <div style={{ color: 'red' }}>{errors.password}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="password_confirmation">Confirm Password:</label>
          <input
            id="password_confirmation"
            type="password"
            value={data.password_confirmation}
            onChange={e => setData('password_confirmation', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.password_confirmation && (
            <div style={{ color: 'red' }}>{errors.password_confirmation}</div>
          )}
        </div>
        <button
          type="submit"
          disabled={processing}
          style={{
            width: '100%',
            padding: 10,
            border: '2px solid black',
            background: 'green',
            color: 'white',
          }}
        >
          Register
        </button>
      </form>
    </div>
  );
}
