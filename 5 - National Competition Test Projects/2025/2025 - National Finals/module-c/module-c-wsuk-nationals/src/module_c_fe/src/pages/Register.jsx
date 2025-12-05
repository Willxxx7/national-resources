import { useContext, useState } from 'react';
import { api } from '../api/api.js';
import { AuthContext } from '../context/auth/AuthContext.jsx';
import { NavLink, useNavigate } from 'react-router-dom';
import { CustomerContext } from '../context/customer/CustomerContext.jsx';

const Register = () => {
  const [firstName, setFirstName] = useState('');
  const [lastName, setLastName] = useState('');
  const [firstAddress, setFirstAddress] = useState('');
  const [secondAddress, setSecondAddress] = useState('');
  const [postcode, setPostcode] = useState('');
  const [email, setEmail] = useState('');
  const [phone, setPhone] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const { setToken } = useContext(AuthContext);
  const { setCustomer } = useContext(CustomerContext);
  const nav = useNavigate();

  const handleFormSubmit = (e) => {
    e.preventDefault();

    // check if required fields are filled
    if (
      firstName.trim().length === 0 ||
      lastName.trim().length === 0 ||
      firstAddress.trim().length === 0 ||
      postcode.trim().length === 0 ||
      email.trim().length === 0 ||
      password.trim().length === 0 ||
      phone.trim().length === 0
    ) {
      setError('Some of the required(*) fields are empty!');
      return;
    }

    api
      .post('/register', {
        customerFirstname: firstName,
        customerLastname: lastName,
        customerEmail: email,
        customerPhone: phone,
        customerAddressFirst: firstAddress,
        customerAddressSecond: secondAddress,
        customerPostcode: postcode,
        customerPassword: password,
      })
      .then((r) => {
        window.localStorage.setItem('auth-token', r.data.token);
        setToken(r.data.token);
        setCustomer(r.data.customer);
        nav('/');
      })
      .catch((e) => {
        if (e.response.status === 422) {
          setError(e.response.data.data[0]);
        }
        console.error(e);
      });
  };

  return (
    <div className="flex justify-center items-center flex-1">
      <div className="rounded-md w-full max-w-3xl p-8">
        <div className="flex flex-col gap-8 items-center bg-white p-8 rounded-sm border border-gray-200 shadow-lg">
          <div className="space-y-4">
            <h2 className="text-4xl text-center font-bold text-primary-light">
              Register
            </h2>
            <h3 className="text-2xl text-center text-gray-600">
              ...and order instantly!
            </h3>
          </div>
          {error.trim().length > 0 && (
            <p className="text-2xl font-semibold text-red-800 text-center">
              {error}
            </p>
          )}
          <form
            className="flex flex-col sm:grid grid-cols-2 gap-4 sm:gap-6 w-full sm:mx-auto"
            onSubmit={handleFormSubmit}
          >
            {/*firstname*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="firstname">
                Firstname
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="text"
                id="firstname"
                placeholder="Customer Firstname"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setFirstName(e.target.value)}
                value={firstName}
              />
            </div>
            {/*lastname*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="lastname">
                Lastname
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="text"
                id="lastname"
                placeholder="Customer Lastname"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setLastName(e.target.value)}
                value={lastName}
              />
            </div>
            {/*address first*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="address_first">
                First address line
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="text"
                id="address_first"
                placeholder="First Address Line"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setFirstAddress(e.target.value)}
                value={firstAddress}
              />
            </div>
            {/*address second*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="address_second">
                Second address line
              </label>
              <input
                type="text"
                id="address_second"
                placeholder="Second Address Line (optional)"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setSecondAddress(e.target.value)}
                value={secondAddress}
              />
            </div>
            {/*postcode*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="address_second">
                Postcode
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="text"
                id="postcode"
                placeholder="Postcode"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setPostcode(e.target.value)}
                value={postcode}
              />
            </div>
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
            {/*phone*/}
            <div className="flex flex-col gap-2">
              <label className="font-semibold text-lg" htmlFor="phone">
                Phone
                <span className="text-red-800 text-xl">*</span>
              </label>
              <input
                type="text"
                id="phone"
                placeholder="Customer Mobile"
                className="border-1 border-gray-500 p-1 rounded-sm shadow-sm"
                onChange={(e) => setPhone(e.target.value)}
                value={phone}
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
              className="sm:col-span-2 bg-primary-light hover:bg-primary-dark hover:bg-neutral-800 text-white text-xl py-2 px-4 rounded-md font-bold text-center hover:bg-dark-blue-3 cursor-pointer"
            >
              Register
            </button>
          </form>
          <div className="flex items-center gap-2">
            <p className="text-gray-600">Already have an account with us?</p>
            <NavLink className="text-primary" to="/login">
              Login Now!
            </NavLink>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Register;
