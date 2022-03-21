import "./Cart.css";

export const Cart = ({children}) => {
    return (
        <div className="Cart">
            <h3>Vos articles</h3>
            <div className="items">
                {children}
            </div>
            <div className="empty-container">
                <div className="empty">Vider le panier</div>
            </div>
        </div>
    )
}