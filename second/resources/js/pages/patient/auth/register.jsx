import React from 'react';
import { useForm } from '@inertiajs/react';

export default function PatientRegister() {
  const { data, setData, post, processing, errors } = useForm({
    first_name: '',
    last_name: '',
    email: '',
    date_of_birth: '',
    gender: 'Male',
    phone_number: '',
    address: '',
    password: '',
    password_confirmation: '',
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('patient.register'));
  };

  return (
    <div style={{ maxWidth: 400, margin: 'auto', padding: 32 }}>
      <h1>Patient Registration</h1>
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
          <label htmlFor="date_of_birth">Date of Birth:</label>
          <input
            id="date_of_birth"
            type="date"
            value={data.date_of_birth}
            onChange={e => setData('date_of_birth', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.date_of_birth && <div style={{ color: 'red' }}>{errors.date_of_birth}</div>}
        </div>
        <div style={{ marginBottom: 16 }}>
          <label htmlFor="gender">Gender:</label>
          <select
            id="gender"
            value={data.gender}
            onChange={e => setData('gender', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
          {errors.gender && <div style={{ color: 'red' }}>{errors.gender}</div>}
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
          <label htmlFor="address">Address:</label>
          <input
            id="address"
            type="text"
            value={data.address}
            onChange={e => setData('address', e.target.value)}
            required
            style={{ width: '100%', padding: 8, border: '2px solid black' }}
          />
          {errors.address && <div style={{ color: 'red' }}>{errors.address}</div>}
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
