import React from 'react';
import { useForm } from '@inertiajs/react';

export default function Dashboard() {
  const { post, processing } = useForm();

  const handleLogout = (e) => {
    e.preventDefault();
    post(route('labtechnician.logout'));
  };

  return (
    <div style={{
      maxWidth: 600,
      margin: '40px auto',
      padding: 24,
      border: '2px solid #333',
      borderRadius: 8,
      boxShadow: '0 4px 8px rgba(0,0,0,0.1)',
      fontFamily: 'Arial, sans-serif',
      textAlign: 'center',
    }}>
      <h1 style={{ marginBottom: 24, color: '#2c3e50' }}>Lab Technician Dashboard</h1>

      <p style={{ fontSize: 18, marginBottom: 32, color: '#34495e' }}>
        Welcome to your dashboard! Manage your tasks and appointments here.
      </p>

      <button
        onClick={handleLogout}
        disabled={processing}
        style={{
          padding: '12px 24px',
          fontSize: 16,
          backgroundColor: '#e74c3c',
          color: 'white',
          border: 'none',
          borderRadius: 6,
          cursor: 'pointer',
          transition: 'background-color 0.3s ease',
        }}
        onMouseOver={e => e.currentTarget.style.backgroundColor = '#c0392b'}
        onMouseOut={e => e.currentTarget.style.backgroundColor = '#e74c3c'}
      >
        Logout
      </button>
    </div>
  );
}
