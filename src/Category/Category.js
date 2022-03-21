import "./Category.css";

export const Category = () => {

    const categories = [
        "category 1",
        "category 2",
        "category 3",
        "category 4",
    ]

    return (
        <div className="select">
            <select>
                {categories.map(category => <option key={categories.indexOf(category)} value={category}>{category}</option>)}
            </select>
            <div className="select_arrow">
            </div>
        </div>
    )
}