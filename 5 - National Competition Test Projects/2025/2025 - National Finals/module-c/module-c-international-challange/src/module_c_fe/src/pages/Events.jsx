import {useEffect, useState} from "react";
import {api} from "../api/api.js";
import EventBox from "../components/events/EventBox.jsx";


const Events = () => {

    const [events, setEvents] = useState([]);
    const [pagination, setPagination] = useState([]);
    const [categories, setCategories] = useState([]);

    /*loading state for api call*/
    const [loading, setLoading] = useState(false);

    /*states for filtering*/
    const [queryString, setQueryString] = useState("");
    const [search, setSearch] = useState("");
    const [dateFrom, setDateFrom] = useState("");
    const [dateTo, setDateTo] = useState("");
    const [date, setDate] = useState("");
    const [categoryId, setCategoryId] = useState("");
    const [currentPage, setCurrentPage] = useState(1);
    const [sort, setSort] = useState("asc");


    /*
    Fetch categories only - this only need to run on initial load to fetch all categories
     */
    useEffect(() => {

        const fetchData = async () => {
            try {
                const response = await api.get('categories');
                ;
                setCategories(response.data.categories);
            } catch (e) {
                console.error(e);
                alert("Failed to fetch categories. See console for more info.")
            }
        };

        fetchData();

    }, []);


    /*
    We only fetch event data in this effect - it is affected by filter changes
     */
    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            /*reset states on every fetch*/
            setEvents([]);
            setPagination([]);
            /*append pictures to the query string*/
            try {
                const finalQueryString = queryString + "&pictures";
                const response = await api.get(`events?${finalQueryString}&page=${currentPage}&sort=${sort}`);
                setEvents(response.data.events);
                setPagination(response.data.pagination);
                /*remove loading after fetch*/
                setLoading(false);
            } catch (e) {
                console.error(e);
                alert("Failed to fetch events! See console for more info.");

            }
        };

        fetchData();
    }, [queryString, currentPage, sort]);


    useEffect(() => {
        const params = new URLSearchParams();


        if (dateFrom) {
            params.append('from', dateFrom);
        }

        if (dateTo) {
            params.append('to', dateTo);
        }

        if (date) {
            params.append('date', date);
        }

        if (categoryId) {
            params.append('cat', categoryId);
        }

        if (name) {
            params.append("name", name);
        }

        if (search) {
            params.append('search', search);
        }

        setQueryString(params.toString());
        // always reset to page 1
        setCurrentPage(1);
    }, [search, dateFrom, dateTo, categoryId, date]);


    /**
     * Remove all filters and reset to page 1
     */
    const clearFilter = () => {
        setSearch("");
        setDateFrom("");
        setDateTo("");
        setDate("");
        setCategoryId("");
        setSort("asc");
        setCurrentPage(1);
    }

    return (
        <div className={"flex flex-col gap-8"}>
            <div className={"space-y-4"}>
                <h2 className={"text-4xl text-center font-bold text-primary-light"}>Public Events</h2>
                <h3 className={"text-2xl text-center text-gray-600"}>Browse from our publicly available events!</h3>
            </div>
            {/*event filtering*/}
            <div className={"w-screen mx-[calc(50%-50vw)] bg-gray-50"}>
                <div className={"max-w-[1400px] mx-auto px-4 py-8 flex flex-col gap-8"}>
                    <div className={"flex gap-4 justify-between flex-wrap md:grid grid-cols-3 md:justify-center"}>
                        <div className={"flex gap-4 md:justify-self-start"}>
                            {/*city or name*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"search"}>Search</label>
                                <input type={"text"} id={"search"} placeholder={"City or event name"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setSearch(e.target.value)} value={search}/>
                            </div>
                        </div>
                        {/*date range filter*/}
                        <div className={"flex gap-4 md:justify-self-center"}>
                            {/*date from*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"date_from"}>Date From
                                    (inc.)</label>
                                <input type={"date"} id={"date_from"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setDateFrom(e.target.value)} value={dateFrom}/>
                            </div>
                            {/*date to*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"date_to"}>Date To (ecx.)</label>
                                <input type={"date"} id={"date_to"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setDateTo(e.target.value)} value={dateTo}/>
                            </div>
                            {/*exact date*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"date"}>Date</label>
                                <input type={"date"} id={"date"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setDate(e.target.value)} value={date}/>
                            </div>
                        </div>
                        <div className={"flex gap-4 md:justify-self-end"}>
                            {/*category*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"category"}>Category</label>
                                <select className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"} id={"category"}
                                        onChange={e => setCategoryId(e.target.value)} value={categoryId}>
                                    <option selected={categoryId === ""} value={""}>---Select a category---</option>
                                    {
                                        categories.map(category => {
                                            return <option selected={categoryId === category.categoryId}
                                                           key={category.categoryId}
                                                           value={category.categoryId}>{category.categoryName}</option>;
                                        })
                                    }
                                </select>
                            </div>
                            {/*sorting by date*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"}>Sort by Date</label>
                                <select className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"} value={sort}
                                        onChange={e => setSort(e.target.value)}>
                                    <option value={"asc"} selected={sort === "asc"}>Ascending</option>
                                    <option value={"desc"} selected={sort === "desc"}>Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div className={"flex flex-col gap-8"}>
                        <button onClick={clearFilter}
                                className={"self-start bg-primary-light hover:bg-primary-dark text-white text-xl py-2 px-4 rounded-sm font-bold text-center cursor-pointer"}>Clear
                            Filter
                        </button>
                        {/*pagination*/}
                        <div className={"flex gap-1 flex-col"}>
                            <p className={"text-gray-600"}>
                                {events.length === 0 ?
                                    <>
                                        Showing 0 results
                                    </>
                                    : <>
                                        Showing
                                        Results {(currentPage - 1) * pagination.perPage + 1} to {currentPage === pagination.lastPage ? pagination.total : currentPage * pagination.perPage} of {pagination.total}
                                    </>
                                }
                            </p>
                            <div className={"flex gap-2"}>
                                {
                                    Array.from({length: pagination.lastPage}, (_, num) => {
                                        return <button
                                            className={`text-dark-1 border-1 rounded-sm border-gray-200 px-4 py-2 font-semibold text-lg hover:bg-gray-100 cursor-pointer ${currentPage === num + 1 ? "bg-zinc-200" : ""}`}
                                            onClick={() => {
                                                setCurrentPage(num + 1)
                                            }}>{num + 1}</button>
                                    })
                                }
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/*event boxes*/}
            <div className={"flex flex-wrap flex-col md:grid grid-cols-3 gap-8"}>
                {
                    loading ? <p>Loading...</p> :
                        events.length === 0 ?
                            <p>No events found for the current filter!</p>
                            :
                            events.map(event => {
                                return (
                                    <EventBox key={event.eventId} event={event}/>
                                );
                            })}
            </div>
        </div>
    );
};

export default Events;