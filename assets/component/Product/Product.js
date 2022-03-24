
import "./Product.css";
import "./QuantitySelector.css";

export const Product = ({product, setIsProductUpdated}) => {

    const {id, title, description, price} = product;

    function handleLessClick(){
        if(product.cart > 0){
            product.cart--;
            setIsProductUpdated(true);
        }
    }

    function handleMoreClick(){
        if(product.cart < product.stock){
            product.cart++;
            setIsProductUpdated(true);
        }
    }

    return (
        <div key={id} className="Product">
            <img src={"images/image" + id + ".png"} alt=""/>
            <div className="content">
                <h3>{title}</h3>
                <span>Description: {description}</span>
                <div className="price">
                    <div className="QuantitySelector">
                        <div className={product.cart > 0 ? "less" : "disabled"} onClick={handleLessClick}>-</div>
                        <span>{product.cart}</span>
                        <div className={product.cart < product.stock ? "more" : "disabled"} onClick={handleMoreClick}>+</div>
                    </div>
                    <span>${price}</span>
                </div>
            </div>
        </div>
    )
}