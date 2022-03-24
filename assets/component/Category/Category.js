
import "./Category.css";

export const Category = ({setCategory}) => {

    const categories = [
        {id: 0, name: "all"},
        {id: 1, name: "category 1"},
        {id: 2, name: "category 2"},
        {id: 3, name: "category 3"},
    ]

    return (
        <div className="select">
            <select onChange={(e) => setCategory(parseInt(e.target.value))}>
                {categories.map(category => <option key={categories.indexOf(category)} value={category.id}>{category.name}</option>)}
            </select>
            <div className="select_arrow">
            </div>
        </div>
    )
}