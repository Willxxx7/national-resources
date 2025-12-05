import {useContext, useEffect, useState} from "react";
import {CustomerContext} from "../../../context/customer/CustomerContext.jsx";
import {api} from "../../../api/api.js";

const Details = () => {

    const {customer, setCustomer} = useContext(CustomerContext);

    const [firstName, setFirstName] = useState(customer.customerFirstname);
    const [lastName, setLastName] = useState(customer.customerLastname);
    const [firstAddress, setFirstAddress] = useState(customer.customerAddressFirst);
    const [secondAddress, setSecondAddress] = useState(customer.customerAddressSecond);
    const [postcode, setPostcode] = useState(customer.customerPostcode);
    const [email, setEmail] = useState(customer.customerEmail);
    const [phone, setPhone] = useState(customer.customerPhone);

    const handleFormSubmit = e =>{
        e.preventDefault();

        // check if required fields are filled
        if (firstName.trim().length === 0 || lastName.trim().length === 0 || firstAddress.trim().length === 0 || postcode.trim().length === 0 || phone.trim().length === 0) {
            alert("Some of the required(*) fields are empty!");
            return;
        }

        api.put('/my/profile', {
            customerFirstname: firstName,
            customerLastname: lastName,
            customerPhone: phone,
            customerAddressFirst: firstAddress,
            customerAddressSecond: secondAddress,
            customerPostcode: postcode,
        })
            .then(r => {
                setCustomer(r.data.customer);
                alert("Your details have successfully updated!");
            })
            .catch(e =>{
                alert("Error at updating customer");
                console.log(e);
            })

    }

    useEffect(() => {
        setFirstName(customer.customerFirstname);
        setLastName(customer.customerLastname);
        setFirstAddress(customer.customerAddressFirst);
        setSecondAddress(customer.customerAddressSecond);
        setPostcode(customer.customerPostcode);
        setPhone(customer.customerPhone);
        setEmail(customer.customerEmail);
    }, [customer]);

    return (
        <div className={"flex flex-col gap-4"}>
            <form className={"flex flex-col sm:grid grid-cols-2 gap-4 sm:gap-6 w-full sm:mx-auto"}
                  onSubmit={handleFormSubmit}>
                {/*firstname*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"firstname"}>Firstname
                        <span className={"text-red-800 text-xl"}>*</span>
                    </label>
                    <input type={"text"} id={"firstname"} placeholder={"Customer Firstname"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setFirstName(e.target.value)} value={firstName}/>
                </div>
                {/*lastname*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"lastname"}>Lastname
                        <span className={"text-red-800 text-xl"}>*</span>
                    </label>
                    <input type={"text"} id={"lastname"} placeholder={"Customer Lastname"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setLastName(e.target.value)} value={lastName}/>
                </div>
                {/*address first*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"address_first"}>First address line
                        <span className={"text-red-800 text-xl"}>*</span>
                    </label>
                    <input type={"text"} id={"address_first"} placeholder={"First Address Line"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setFirstAddress(e.target.value)} value={firstAddress}/>
                </div>
                {/*address second*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"address_second"}>Second address line
                    </label>
                    <input type={"text"} id={"address_second"} placeholder={"Second Address Line (optional)"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setSecondAddress(e.target.value)} value={secondAddress}/>
                </div>
                {/*postcode*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"address_second"}>Postcode
                        <span className={"text-red-800 text-xl"}>*</span>
                    </label>
                    <input type={"text"} id={"postcode"} placeholder={"Postcode"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setPostcode(e.target.value)} value={postcode}/>
                </div>
                {/*email address*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"email"}>Email - view only
                    </label>
                    <input type={"email"} disabled={true} id={"email"} placeholder={"Customer Email"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm text-gray-400"}
                           onChange={e => setEmail(e.target.value)} value={email}/>
                </div>
                {/*phone*/}
                <div className={"flex flex-col gap-2"}>
                    <label className={"font-semibold text-lg"} htmlFor={"phone"}>Phone
                        <span className={"text-red-800 text-xl"}>*</span>
                    </label>
                    <input type={"text"} id={"phone"} placeholder={"Customer Mobile"}
                           className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                           onChange={e => setPhone(e.target.value)} value={phone}/>
                </div>
                <button type={"submit"}
                        className={"sm:col-span-2 bg-primary-light hover:bg-primary-dark hover:bg-neutral-800 text-white text-xl py-2 px-4 rounded-md font-bold text-center hover:bg-dark-blue-3 cursor-pointer"}>
                    Update My Details
                </button>
            </form>
        </div>
    );
};

export default Details;