
import "./Cart.css";
import {CartItem} from "../CartItem/CartItem";

export const Cart = ({products, setIsProductUpdated, totalPrice}) => {

    function emptyCart() {
        for(let product of products){
            product.cart = 0;
            setIsProductUpdated(true);
        }
    }

    return (
        <div className="Cart">
            <h3>Vos articles</h3>
            <div className="items">
                {
                    products.map(product =>
                        product.cart > 0 && <CartItem product={product} setIsProductUpdated={setIsProductUpdated} />
                    )
                }
            </div>
            <div className="total-price">{totalPrice > 0 && "$" + totalPrice}</div>
            <div className="empty-container">
                <div className="empty" onClick={emptyCart}>Vider le panier</div>
            </div>
        </div>
    )
}