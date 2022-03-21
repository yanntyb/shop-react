import logo from "../assets/images/logo.png";
import "./Header.css";

export const Header = () => {
    return (
        <div className="Header">
            <img src={logo} alt="Shop logo"/>
        </div>
    )
}