import './assets/style/App.css';
import {Header} from "./Header/Header";
import {ProductList} from "./ProductList/ProductList";
import {Product} from "./Product/Product";
import {Cart} from "./Cart/Cart";
import {CartItem} from "./CartItem/CartItem";
import {Category} from "./Category/Category";

function App() {

    const products = [
        {id: 1, title: "Produit 1", description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum", price: 230},
        {id: 2, title: "Produit 2", description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum", price: 230},
        {id: 3, title: "Produit 3", description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum", price: 230},
        {id: 4, title: "Produit 4", description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum", price: 230},
        {id: 5, title: "Produit 5", description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum", price: 230},
    ]

    const carts = [
        {id: 1, title: "Produit 1", quantity: 2},
        {id: 2, title: "Produit 4", quantity: 4},
        {id: 3, title: "Produit 3", quantity: 4},
    ]

    return (
      <>
        <Header />
          <div className="main-content">
              <Cart >
                  {carts.map(cart => <CartItem data={cart} />)}
              </Cart>
              <div className="right">
                  <Category />
                  <ProductList >
                      {products.map(product => <Product data={product} />)}
                  </ProductList>
              </div>
          </div>

      </>
  )
}

export default App;
