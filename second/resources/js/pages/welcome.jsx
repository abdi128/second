import { router } from '@inertiajs/react';

export default function Welcome() {

    const handleDocLoginClick = () => {
        router.visit(route('login')); // router.visit to the login page
    };
    const handlePatientLoginClick = () => {
        router.visit(route('register')); // router.visit to the login page
    };

    return (
        <div style={styles.container}>
            <h1>Welcome to the Home Page</h1>
            <button onClick={handleDocLoginClick} style={styles.button}>
                Doctors Dashboard
            </button>
            <button onClick={handlePatientLoginClick} style={styles.button}>
                Patients Dashboard
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