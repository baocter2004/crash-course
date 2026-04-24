import { ClipLoader } from "react-spinners";

const Spinner = ({ loading }) => {
  return (
    <div className="flex justify-center items-center w-full m-auto">
      <ClipLoader size={50} color={"#123abc"} loading={loading} />
    </div>
  );
};

export default Spinner;
