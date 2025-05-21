import React from 'react';
import { router } from '@inertiajs/react';

export default function Welcome() {

    const handleDocLoginClick = () => {
        router.visit(route('doctor.login')); // router.visit to the login page
    };
    const handlePatientLoginClick = () => {
        router.visit(route('patient.login')); // router.visit to the login page
    };

    const handleAdminLoginClick = () => {
        router.visit(route('admin.login')); // router.visit to the login page
    };
    const handleLabLoginClick = () => {
        router.visit(route('labtechnician.login')); // router.visit to the login page
    };

    const handlePatientRegisterClick = () => {
        router.visit(route('patient.register')); // router.visit to the login page
    };

    const handleDocRegisterClick = () => {
        router.visit(route('doctor.register')); // router.visit to the login page
    };

    const handleLabRegisterClick = () => {
        router.visit(route('labtechnician.register')); // router.visit to the login page
    };

        const handleAdminRegisterClick = () => {
        router.visit(route('admin.register')); // router.visit to the login page
    };

    return (
        <div style={styles.container}>
            <h1>Welcome to the Home Page</h1>
            <button onClick={handleAdminLoginClick} style={styles.button}>
                Admin Login
            </button>
            <button onClick={handleAdminRegisterClick} style={styles.button}>
                Admin Register
            </button>

            <button onClick={handleDocLoginClick} style={styles.button}>
                Doctor Login
            </button>
            <button onClick={handleDocRegisterClick} style={styles.button}>
                Doctor Register
            </button>

            <button onClick={handleLabLoginClick} style={styles.button}>
                Lab Login
            </button>
            <button onClick={handleLabRegisterClick} style={styles.button}>
                Lab Register
            </button>

            <button onClick={handlePatientLoginClick} style={styles.button}>
                Patient Login
            </button>
            <button onClick={handlePatientRegisterClick} style={styles.button}>
                Patient Register
            </button>

        </div>
    );
}

// Inline styles for simplicity (you can move these to a CSS module if needed)
const styles = {
    container: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        height: '100vh',
        textAlign: 'center',
    },
    button: {
        padding: '10px 20px',
        fontSize: '16px',
        backgroundColor: '#007bff',
        color: '#fff',
        border: 'none',
        borderRadius: '5px',
        cursor: 'pointer',
        marginTop: '20px',
    },
};
