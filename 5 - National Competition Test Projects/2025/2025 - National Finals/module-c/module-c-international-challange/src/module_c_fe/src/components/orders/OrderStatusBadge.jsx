const BadgeWrapper = ({children, border}) => {
    return (
        <div className={`px-4 py-1 border-1 ${border} rounded-3xl bg-gray-50 text-sm`}>
            {children}
        </div>
    );
};

const OrderStatusBadge = ({status}) => {

    if (status === 'confirmed') {
        return (
            <BadgeWrapper border={"border-orange-500"}>
                <span className={"text-orange-500"}>Confirmed</span>
            </BadgeWrapper>
        )
    }

    if (status === "paid") {
        return (
            <BadgeWrapper border={"border-green-500"}>
                <span className={"text-green-500"}>Paid</span>
            </BadgeWrapper>
        );

    }

    if (status === "cancelled") {
        return (
            <BadgeWrapper border={"border-red-500"}>
                <span className={"text-red-500"}>Cancelled</span>
            </BadgeWrapper>
        );
    }
};

export default OrderStatusBadge;