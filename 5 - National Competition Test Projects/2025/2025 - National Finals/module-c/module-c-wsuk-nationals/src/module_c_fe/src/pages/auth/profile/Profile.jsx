import {useContext} from "react";
import {CustomerContext} from "../../../context/customer/CustomerContext.jsx";
import {NavLink, Outlet} from "react-router-dom";

const Profile = () => {

    const {customer} = useContext(CustomerContext);

    return (
        <div className={"flex flex-col gap-8"}>
            <div>
                <h2 className={"text-4xl text-center font-bold text-primary-light"}>{customer.customerFirstname + " " + customer.customerLastname}</h2>
                <h3 className={"text-2xl text-center text-gray-600"}>Manage your Profile</h3>
            </div>
            <div className={"flex gap-6 border-b-2 border-b-primary-dark max-w-fit text-xl"}>
                <NavLink index
                         className={({isActive}) => `pb-1 transition-all duration-300 ${isActive ? 'border-b-4 border-b-primary-dark text-primary-dark' : 'border-b-4 border-b-transparent text-gray-500 hover:text-primary'}`}
                         to={"/profile/details"}>My Details</NavLink>
                <NavLink
                    className={({isActive}) => `pb-1 transition-all duration-300 ${isActive ? 'border-b-4 border-b-primary-dark text-primary-dark' : 'border-b-4 border-b-transparent text-gray-500 hover:text-primary'}`}
                    to={"/profile/orders"}>My Orders</NavLink>
                <NavLink
                    className={({isActive}) => `pb-1 transition-all duration-300 ${isActive ? 'border-b-4 border-b-primary-dark text-primary-dark' : 'border-b-4 border-b-transparent text-gray-500 hover:text-primary'}`}
                    to={"/profile/events"}>My Events</NavLink>
            </div>
            <div>
                <Outlet/>
            </div>
        </div>
    );
};

export default Profile;