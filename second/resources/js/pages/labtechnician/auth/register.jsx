import React from 'react';
import { useForm } from '@inertiajs/react';

export default function LabTechnicianRegister() {
  const { data, setData, post, processing, errors } = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone_number: '',
    specialty: '',
    password: '',
    password_confirmation: '',
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('labtechnician.register'));
  };

  return (
    <div style={{ maxWidth: 400, margin: 'auto', padding: 32 }}>
      <h1>LabTechnician Registration</h1>
      <form onSubmit={handleSubmit}>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="first_name">First Name:</label>
          <input
            id="first_name"
            type="text"
            value={data.first_name}
            onChange={e => setData('first_name', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.first_name && <div style={{ color: 'red' }}>{errors.first_name}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="last_name">Last Name:</label>
          <input
            id="last_name"
            type="text"
            value={data.last_name}
            onChange={e => setData('last_name', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.last_name && <div style={{ color: 'red' }}>{errors.last_name}</div>}
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
          <label htmlFor="phone_number">Phone Number:</label>
          <input
            id="phone_number"
            type="text"
            value={data.phone_number}
            onChange={e => setData('phone_number', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.phone_number && <div style={{ color: 'red' }}>{errors.phone_number}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="specialty">Specialty:</label>
          <input
            id="specialty"
            type="text"
            value={data.specialty}
            onChange={e => setData('specialty', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.specialty && <div style={{ color: 'red' }}>{errors.specialty}</div>}
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
