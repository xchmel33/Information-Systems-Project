import "./Content.css";
import React from "react";
import AuctionCard from "./AuctionCard";

const Content = () => {
  const [auctionArr, setAuctionArr] = React.useState([1]);
  return (
    <div className="Content">
      {auctionArr.map((each) => {
        return (
          <AuctionCard
            img="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Massey_Ferguson_6490_Dynashift.jpg/1200px-Massey_Ferguson_6490_Dynashift.jpg"
            name="name"
            id="id"
            price="price"
            desc="desc"
            timestamp="time"
          />
        );
      })}
    </div>
  );
};

export default Content;
