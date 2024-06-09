import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

const Register = () => {
    const [fullname, setFullname] = useState('');
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('');
    const [errors, setErrors] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.post('/register', {
                fullname,
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            });
            // Handle successful registration (e.g., redirect to home page)
        } catch (error) {
            if (error.response) {
                setErrors(error.response.data.errors);
            }
        }
    };

    return (
        <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
            <h2 className="text-2xl font-bold mb-6">Register</h2>
            {errors.length > 0 && (
                <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong className="font-bold">Whoops!</strong>
                    <span className="block sm:inline"> There were some problems with your input.</span>
                    <ul className="mt-2 list-disc list-inside">
                        {errors.map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}
            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label htmlFor="fullname" className="block text-gray-700">Fullname</label>
                    <input
                        type="text"
                        name="fullname"
                        id="fullname"
                        className="w-full p-2 border border-gray-300 rounded mt-1"
                        value={fullname}
                        onChange={(e) => setFullname(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="name" className="block text-gray-700">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        className="w-full p-2 border border-gray-300 rounded mt-1"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="email" className="block text-gray-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        className="w-full p-2 border border-gray-300 rounded mt-1"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="password" className="block text-gray-700">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        className="w-full p-2 border border-gray-300 rounded mt-1"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="password_confirmation" className="block text-gray-700">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        className="w-full p-2 border border-gray-300 rounded mt-1"
                        value={passwordConfirmation}
                        onChange={(e) => setPasswordConfirmation(e.target.value)}
                    />
                </div>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Register</button>
            </form>
        </div>
    );
};

if (document.getElementById('register')) {
    ReactDOM.render(<Register />, document.getElementById('register'));
}

export default Register;
