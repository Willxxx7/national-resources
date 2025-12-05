import './App.css';
import '../public/assets/fontawesome/css/all.css';
import Header from './components/Header.jsx';
import { Route, Routes } from 'react-router-dom';
import Events from './pages/Events.jsx';
import Event from './pages/Event.jsx';
import Footer from './components/Footer.jsx';
import Login from './pages/Login.jsx';
import Logout from './pages/Logout.jsx';
import Auth from './pages/auth/Auth.jsx';
import Profile from './pages/auth/profile/Profile.jsx';
import Register from './pages/Register.jsx';
import Basket from './pages/auth/Basket.jsx';
import { usePictureSizes } from './hooks/usePictureSizes.js';
import Details from './pages/auth/profile/Details.jsx';
import Orders from './pages/auth/profile/Orders.jsx';
import PrivateEvents from './pages/auth/profile/PrivateEvents.jsx';
import OrderPage from './pages/auth/profile/OrderPage.jsx';

const App = () => {
  // fetch some data on initial app load
  const pictureSizes = usePictureSizes();
  if (pictureSizes === null || pictureSizes.length === 0) {
    return <div>Loading...</div>;
  }

  return (
    <div className={'bg-white min-h-screen'}>
      {/*the page is in a 1400px wrapper*/}
      <div className={'max-w-[1400px] mx-auto flex flex-col min-h-screen'}>
        <Header />
        <main className={'py-8 px-4 flex-1 h-full w-full'}>
          <Routes>
            <Route path={'/'} index={true} element={<Events />} />
            <Route path={'/events/:id'} element={<Event />}></Route>
            <Route path={'/login'} element={<Login />}></Route>
            <Route path={'/register'} element={<Register />}></Route>
            <Route path={'/logout'} element={<Logout />}></Route>
            {/*protected routes*/}
            <Route element={<Auth />}>
              <Route path={'/profile'} element={<Profile />}>
                <Route
                  index
                  path={'/profile/details'}
                  element={<Details />}
                ></Route>
                <Route path={'/profile/orders'} element={<Orders />}></Route>
                <Route
                  path={'/profile/orders/:id'}
                  element={<OrderPage />}
                ></Route>
                <Route
                  path={'/profile/events'}
                  element={<PrivateEvents />}
                ></Route>
              </Route>
              <Route path={'/basket'} element={<Basket />}></Route>
            </Route>
          </Routes>
        </main>
        <Footer />
      </div>
    </div>
  );
};

export default App;
