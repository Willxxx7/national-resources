
const PictureViewerModal= ({pictureViewerModalVisible, setPictureViewerModalVisible, pictureViewerPicture}) => {

    return (
        pictureViewerModalVisible && (
            <>
                {/*backdrop*/}
                <div className={"fixed inset-0 w-full h-full bg-black/60 z-100 flex justify-center items-center"}>
                    {/*modal content*/}
                    <div className={"relative bg-gray-50 p-6 rounded-sm w-full sm:min-w-[25%] sm:max-w-[60%] flex flex-col gap-8 shadow-md shadow-white"}>
                        {/*close button*/}
                        <button
                            className={"absolute right-4 top-4 border-1 rounded-sm border-gray-200 px-4 py-2 font-semibold text-xl bg-gray-100 hover:bg-zinc-400 cursor-pointer"}
                            onClick={() => {setPictureViewerModalVisible(false)}}>X
                        </button>
                        {/*picture*/}
                        <div className={"w-full flex justify-center"}>
                            <img alt={""} src={"http://localhost:8000/storage/" + pictureViewerPicture.picturePath} className={"w-full object-contain max-h-[80vh]"}/>
                        </div>
                    </div>
                </div>
            </>
        )
    );
};

export default PictureViewerModal;