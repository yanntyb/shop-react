
import "./ProductList.css";
import {Product} from "../Product/Product";

export const ProductList = ({products, setIsProductUpdated, category}) => {
    return (
        <div className="ProductList">
            {
                products
                    .filter(product =>
                        category === 0 || product.category === category
                    )
                    .map(product =>
                        <Product key={product.id} product={product} setIsProductUpdated={setIsProductUpdated} />
                    )
            }
        </div>
    )
}