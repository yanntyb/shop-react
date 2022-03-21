import "./Product.css";
import {QuantitySelector} from "../QuantitySelector/QuantitySelector";

export const Product = ({data}) => {

    const {id, title, description, price} = data;

    return (
        <div key={id} className="Product">
            <img src={"images/image" + id + ".png"} alt=""/>
            <div className="content">
                <h3>{title}</h3>
                <span>Description: {description}</span>
                <div className="price">
                    <QuantitySelector/>
                    <span>${price}</span>
                </div>
            </div>
        </div>
    )
}