import { NavLink } from 'react-router-dom';
import { useContext } from 'react';
import { AuthContext } from '../context/auth/AuthContext.jsx';
import logo from '../images/logo.svg';
import { BasketContext } from '../context/basket/BasketContext.jsx';

const Header = () => {
  const { isLoggedIn } = useContext(AuthContext);
  const { basketItems } = useContext(BasketContext);

  return (
    /*we have a header that is full width, but the content is centered with a width of 1400px*/
    <header
      className={
        'sticky top-0 z-50 border-b w-screen mx-[calc(50%-50vw)] bg-dark-1 text-white! backdrop-blur'
      }
    >
      <div
        className={
          'max-w-[1400px] mx-auto px-8 lg:px-4 py-4 flex gap-4 justify-between items-center flex-wrap sm:flex-nowrap'
        }
      >
        <h1
          className={
            'text-2xl text-dark-blue-1 font-bold flex items-center gap-2'
          }
        >
          <div className={'w-[5%] min-w-[50px]'}>
            <img src={logo} alt={'Spark studios logo'} />
          </div>
          Spark Studios
        </h1>
        <nav className={'text-xl'}>
          <ul className={'flex gap-4 items-center'}>
            {/*always visible*/}
            <li>
              <NavLink
                className={'hover:text-subtle transition-colors'}
                to={'/'}
              >
                Events
              </NavLink>
            </li>

            {/*visible only if user is logged out*/}
            {!isLoggedIn && (
              <>
                <NavLink
                  className={'hover:text-subtle transition-colors'}
                  to={'/login'}
                >
                  Login
                </NavLink>
                <NavLink
                  className={'hover:text-subtle transition-colors'}
                  to={'/register'}
                >
                  Register
                </NavLink>
              </>
            )}
            {/*visible only when user logged in*/}
            {isLoggedIn && (
              <>
                <NavLink
                  className={'hover:text-subtle transition-colors'}
                  to={'/profile'}
                >
                  Profile
                </NavLink>
                <NavLink
                  className={'hover:text-subtle transition-colors relative'}
                  to={'/basket'}
                >
                  Basket
                  <span
                    className={
                      'absolute -top-4 -right-5 p-1 bg-primary flex justify-center items-center text-white rounded-full w-[25px] h-[25px] text-sm'
                    }
                  >
                    {basketItems.length}
                  </span>
                </NavLink>
                <NavLink
                  className={'hover:text-subtle transition-colors'}
                  to={'/logout'}
                >
                  Logout
                </NavLink>
              </>
            )}
          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;
