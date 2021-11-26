import "./Header.css";
import React from "react";
import MenuItem from "@mui/material/MenuItem";
import FormControl from "@mui/material/FormControl";
import Select from "@mui/material/Select";
import TextField from "@mui/material/TextField";
import SearchIcon from "@mui/icons-material/Search";
import MenuIcon from "@mui/icons-material/Menu";
import Menu from "@mui/material/Menu";

const Header = () => {
  const [auctionType, setAuctionType] = React.useState(0);
  const [anchorEl, setAnchorEl] = React.useState(null);

  const handleChange = (event) => {
    setAuctionType(event.target.value);
  };

  const open = Boolean(anchorEl);

  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <div className="header headerFlex">
      <div className="leftSide headerFlex">
        <div className="navIcons">
          <FormControl>
            <Select value={auctionType} onChange={handleChange}>
              <MenuItem value={0}>Nabidky</MenuItem>
              <MenuItem value={1}>Poptavky</MenuItem>
            </Select>
          </FormControl>
        </div>
        <div className="navSearch">
          <TextField label="Hledat" variant="outlined" />
          <SearchIcon className="searchIcon" />
        </div>
      </div>
      <div className="navTitle">Aukro 2.0</div>
      <div className="rightSide headerFlex">
        <div className="navAuth">Přihlásit se</div>
        <MenuIcon
          className="MenuIcon"
          aria-controls="basic-menu"
          aria-haspopup="true"
          aria-expanded={open ? "true" : undefined}
          onClick={handleClick}
        />
        <div>
          <Menu
            id="basic-menu"
            anchorEl={anchorEl}
            open={open}
            onClose={handleClose}
            MenuListProps={{
              "aria-labelledby": "basic-button",
            }}
          >
            <MenuItem onClick={handleClose}>Nová nabídka</MenuItem>
            <MenuItem onClick={handleClose}>Nová poptávka</MenuItem>

            <MenuItem onClick={handleClose}>Moje aukce</MenuItem>
            <MenuItem onClick={handleClose}>Odhlásit se</MenuItem>
          </Menu>
        </div>
      </div>
    </div>
  );
};

export default Header;
