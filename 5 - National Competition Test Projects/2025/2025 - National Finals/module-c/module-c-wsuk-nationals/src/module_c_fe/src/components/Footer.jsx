const Footer = () => {
  return (
    <footer className="bg-dark-1 text-white w-screen mx-[calc(50%-50vw)] mt-auto">
      <div className="max-w-[1400px] mx-auto px-4">
        <h3 className="text-center text-4xl sm:text-6xl text-gray-400 flex items-center justify-center h-[160px]">
          Find your Spark!
        </h3>
        <div className="border-t-[0.5px] border-opacity-70 border-t-gray-800 text-center text-gray-400 py-1">
          &copy; {new Date().getFullYear()} Spark Studios
        </div>
      </div>
    </footer>
  );
};
export default Footer;
