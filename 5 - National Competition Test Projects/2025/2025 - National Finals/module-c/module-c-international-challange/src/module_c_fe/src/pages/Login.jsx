import { useContext, useEffect, useState } from 'react';
import { api } from '../api/api.js';
import { AuthContext } from '../context/auth/AuthContext.jsx';
import { NavLink, useNavigate } from 'react-router-dom';
import { CustomerContext } from '../context/customer/CustomerContext.jsx';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const { setToken, isLoggedIn } = useContext(AuthContext);
  const { setCustomer } = useContext(CustomerContext);
  const nav = useNavigate();

  // if user is already logged in, redirect to index
  useEffect(() => {
    if (isLoggedIn) {
      nav('/');
      return;
    }
  }, [isLoggedIn, nav]);

  // handle login form submission
  const handleFormSubmit = (e) => {
    e.preventDefault();
    // check if email and password are provided
    if (email.trim().length === 0 || password.trim().length === 0) {
      setError('Email and password are required!');
      return;
    }
    setError('');

    // perform login call
    api
      .post('/login', { email: email, password: password })
      .then((r) => {
        window.localStorage.setItem('auth-token', r.data.token);
        setToken(r.data.token);
        setCustomer(r.data.customer);
        nav('/login');
      })
      .catch((e) => {
        setError(e.response.data.message);
      });
  };

  return (
    <div className="flex justify-center items-center flex-1">
      <div className="rounded-md w-full max-w-lg p-8">
        <div className="flex flex-col gap-8 items-center bg-white p-8 rounded-sm border-gray-200 border-1 shadow-xl">
          <div className="space-y-4">
            <h2 className="text-4xl text-center font-bold text-primary-light">
              Login
            </h2>
            <h3 className="text-xl sm:text-2xl text-center text-gray-600">
              To order from our high variety images!
            </h3>
          </div>
          {error.trim().length > 0 && (
            <p className="text-2xl font-semibold text-red-800 text-center">
              {error}
            </p>
          )}
          <form
            className="flex flex-col gap-6 w-full sm:mx-auto"
            onSubmit={handleFormSubmit}
          >
            {/*email address*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="email">
                Email
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="email"
                id="email"
                placeholder="Customer Email"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setEmail(e.target.value)}
                value={email}
              />
            </div>
            {/*password*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="password">
                Password
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="password"
                id="password"
                placeholder="Customer Password"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setPassword(e.target.value)}
                value={password}
              />
            </div>
            <button
              type="submit"
              className="bg-primary-light hover:bg-primary-dark text-white text-xl py-2 px-4 rounded-sm font-bold text-center hover:bg-dark-blue-3 cursor-pointer"
            >
              Login
            </button>
          </form>
          <div className="flex items-center gap-2">
            <p className="text-gray-600">Not yet an account holder?</p>
            <NavLink className="text-primary" to="/register">
              Register Now!
            </NavLink>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;
