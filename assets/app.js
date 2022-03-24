import './style/App.css';
import React from 'react';
import {Header} from "./component/Header/Header";
import {ProductList} from "./component/ProductList/ProductList";
import {Cart} from "./component/Cart/Cart";
import {Category} from "./component/Category/Category";
import {useState} from "react";

function App() {

    const productsList = [
        {
            id: 1,
            title: "Produit 1",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum",
            price: 230,
            cart: 0,
            stock: 20,
            category: 3,
        },
        {
            id: 2,
            title: "Produit 2",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum",
            price: 230,
            cart: 0,
            stock: 20,
            category: 0,
        },
        {
            id: 3,
            title: "Produit 3",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum",
            price: 230,
            cart: 0,
            stock: 20,
            category: 1,
        },
        {
            id: 4,
            title: "Produit 4",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum",
            price: 230,
            cart: 0,
            stock: 20,
            category: 1,
        },
        {
            id: 5,
            title: "Produit 5",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis turpis sit amet metus mollis faucibus. Ut ac neque nisl. Nullam feugiat, quam at ullamcorper bibendum",
            price: 230,
            cart: 0,
            stock: 20,
            category: 2,
        },
    ]

    const [products, setProducts] = useState(productsList);
    let [totalPrice, setTotalPrice] = useState(0);
    const [isProductUpdated, setIsProductUpdated] = useState(false);
    const [category, setCategory] = useState(0);


    if(isProductUpdated){
        totalPrice = 0;
        for(const product of products){
            if(product.cart > 0){
                totalPrice += product.cart * product.price;
            }
        }
        setTotalPrice(totalPrice);
        setProducts(products);
        setIsProductUpdated(false);

    }

    return (
        <>
            <Header/>
            <div className="main-content">
                <Cart products={products} setIsProductUpdated={setIsProductUpdated} totalPrice={totalPrice}/>
                <div className="right">
                    <Category setCategory={setCategory}/>
                    <ProductList category={category} products={products} setIsProductUpdated={setIsProductUpdated} />
                </div>
            </div>

        </>
    )
}

export default App;
