//const mongoose = require('mongoose');

//mongoose.connect(`mongodb+srv://${encodeURIComponent('<thanuka5>')}:${encodeURIComponent('<kmSwCYBScjMH8O7V>')}@cluster0.zuuajzp.mongodb.net/?retryWrites=true&w=majority`);
//mongoose.connect("mongodb+srv://thanuka5:kmSwCYBScjMH8O7V@cluster0.zuuajzp.mongodb.net/?retryWrites=true&w=majority");
//.then(()=>console.log("Connected to MongoDB"))
//.catch(err=>console.log(err))
/*
const mongoose = require('mongoose');

mongoose.connect("mongodb+srv://thanuka5:kmSwCYBScjMH8O7V@cluster0.zuuajzp.mongodb.net/?retryWrites=true&w=majority", {
  useNewUrlParser: true,
  useUnifiedTopology: true,
})
  .then(() => console.log('Connected to MongoDB'))
  .catch(err => console.error('Failed to connect to MongoDB', err));

const itemSchema = new mongoose.Schema({
  item_name: String,
  category_name: String,
  brand_name: String,
  price: Number,
  image_url: String
});

const Item = mongoose.model('Item', itemSchema);

async function seedData() {
  await Item.insertMany([
    { item_name: 'Apples', category_name: 'Fruits', brand_name: 'Organic Farms', price: 2.99, image_url: 'https://i5.walmartimages.ca/images/Thumbnails/094/514/6000200094514.jpg' },
    { item_name: 'Bacon', category_name: 'Meat', brand_name: 'Hickory Smoked', price: 7.99, image_url: 'https://i5.walmartimages.ca/images/Thumbnails/182/876/6000204182876.jpg' },
    { item_name: 'Chicken Breast', category_name: 'Meat', brand_name: 'Farm Fresh', price: 5.99, image_url: 'https://example.com/chickenbreast.jpg' },
    { item_name: 'Tofu', category_name: 'Vegetarian', brand_name: 'Organic Tofu', price: 2.49, image_url: 'https://example.com/tofu.jpg' },
    { item_name: 'Almonds', category_name: 'Nuts', brand_name: 'Nutty Naturals', price: 8.99, image_url: 'https://example.com/almonds.jpg' },
    { item_name: 'Brie Cheese', category_name: 'Dairy', brand_name: 'Cheese World', price: 6.49, image_url: 'https://example.com/brie.jpg' },
    { item_name: 'Whole Grain Bread', category_name: 'Bakery', brand_name: 'Healthy Bakes', price: 3.49, image_url: 'https://example.com/wholegrainbread.jpg' },
    { item_name: 'Chocolate Ice Cream', category_name: 'Dessert', brand_name: 'Choco Delight', price: 4.99, image_url: 'https://example.com/chocoicecream.jpg' },
    { item_name: 'Chia Seeds', category_name: 'Health Foods', brand_name: 'Nature Pure', price: 5.49, image_url: 'https://example.com/chiaseeds.jpg' },
    { item_name: 'Zucchini', category_name: 'Vegetables', brand_name: 'Farm Fresh', price: 1.99, image_url: 'https://example.com/zucchini.jpg' },
    { item_name: 'Organic Honey', category_name: 'Pantry', brand_name: 'Sweet Bees', price: 6.99, image_url: 'https://example.com/honey.jpg' },
    { item_name: 'Cereal', category_name: 'Breakfast', brand_name: 'Morning Foods', price: 3.99, image_url: 'https://example.com/cereal.jpg' },
    { item_name: 'Sardines', category_name: 'Seafood', brand_name: 'Ocean Fresh', price: 2.49, image_url: 'https://example.com/sardines.jpg' },
    { item_name: 'Pepperoni', category_name: 'Deli', brand_name: 'Delicious Meats', price: 5.99, image_url: 'https://example.com/pepperoni.jpg' },
    { item_name: 'Maple Syrup', category_name: 'Pantry', brand_name: 'Maple Grove', price: 7.49, image_url: 'https://example.com/maplesyrup.jpg' },
    { item_name: 'Asparagus', category_name: 'Vegetables', brand_name: 'Green Foods', price: 4.49, image_url: 'https://example.com/asparagus.jpg' },
    { item_name: 'Sausages', category_name: 'Meat', brand_name: 'Grill Masters', price: 6.99, image_url: 'https://example.com/sausages.jpg' },
    { item_name: 'Lamb Chops', category_name: 'Meat', brand_name: 'Hillside Farms', price: 14.99, image_url: 'https://example.com/lambchops.jpg' },
    { item_name: 'Hazelnuts', category_name: 'Nuts', brand_name: 'Nutty Naturals', price: 9.49, image_url: 'https://example.com/hazelnuts.jpg' },
    { item_name: 'Rye Bread', category_name: 'Bakery', brand_name: 'Bakery Delights', price: 3.99, image_url: 'https://example.com/ryebread.jpg' },
    { item_name: 'Mango Juice', category_name: 'Beverages', brand_name: 'Tropical Sips', price: 2.49, image_url: 'https://example.com/mangojuice.jpg' },
    { item_name: 'Celery', category_name: 'Vegetables', brand_name: 'Green Crunch', price: 1.49, image_url: 'https://example.com/celery.jpg' },
    { item_name: 'Mozzarella Cheese', category_name: 'Dairy', brand_name: 'Cheese Haven', price: 5.49, image_url: 'https://example.com/mozzarella.jpg' },
    { item_name: 'Olive Oil', category_name: 'Pantry', brand_name: 'Mediterranean Gold', price: 8.99, image_url: 'https://example.com/oliveoil.jpg' },
    { item_name: 'Lentils', category_name: 'Pantry', brand_name: 'Hearty Foods', price: 2.99, image_url: 'https://example.com/lentils.jpg' },
    { item_name: 'Pistachios', category_name: 'Nuts', brand_name: 'Nutty Delight', price: 10.99, image_url: 'https://example.com/pistachios.jpg' },
    { item_name: 'Clams', category_name: 'Seafood', brand_name: 'Oceanic Tastes', price: 6.49, image_url: 'https://example.com/clams.jpg' },
    { item_name: 'Raspberries', category_name: 'Fruits', brand_name: 'Berry Fresh', price: 4.99, image_url: 'https://example.com/raspberries.jpg' },
    { item_name: 'Green Tea', category_name: 'Beverages', brand_name: 'Zen Brews', price: 3.49, image_url: 'https://example.com/greentea.jpg' },
    { item_name: 'Mushrooms', category_name: 'Vegetables', brand_name: 'Forest Finds', price: 2.99, image_url: 'https://example.com/mushrooms.jpg' },
    { item_name: 'Pomegranate', category_name: 'Fruits', brand_name: 'Ruby Fruits', price: 2.49, image_url: 'https://example.com/pomegranate.jpg' },
    { item_name: 'Canned Tuna', category_name: 'Pantry', brand_name: 'Ocean Delights', price: 1.99, image_url: 'https://example.com/tuna.jpg' },
    { item_name: 'Mustard', category_name: 'Pantry', brand_name: 'Zesty Tastes', price: 1.49, image_url: 'https://example.com/mustard.jpg' },
    { item_name: 'Oregano', category_name: 'Pantry', brand_name: 'Herb Heaven', price: 0.99, image_url: 'https://example.com/oregano.jpg' },
    { item_name: 'Flax Seeds', category_name: 'Health Foods', brand_name: 'Pure Nature', price: 2.49, image_url: 'https://example.com/flaxseeds.jpg' },
    { item_name: 'Acai Berries', category_name: 'Fruits', brand_name: 'Tropical Delight', price: 5.99, image_url: 'https://example.com/acai.jpg' },
    { item_name: 'Goat Cheese', category_name: 'Dairy', brand_name: 'Mountain Farms', price: 5.49, image_url: 'https://example.com/goatcheese.jpg' },
    { item_name: 'Cinnamon Sticks', category_name: 'Pantry', brand_name: 'Aromatic Spices', price: 3.99, image_url: 'https://example.com/cinnamon.jpg' },
    { item_name: 'Ginger Root', category_name: 'Vegetables', brand_name: 'Aromatic Farms', price: 1.99, image_url: 'https://example.com/ginger.jpg' },
    { item_name: 'Protein Bar', category_name: 'Health Foods', brand_name: 'ProFit', price: 2.49, image_url: 'https://example.com/proteinbar.jpg' },
    { item_name: 'Pumpkin Seeds', category_name: 'Nuts', brand_name: 'Seedful', price: 3.49, image_url: 'https://example.com/pumpkinseeds.jpg' },
    { item_name: 'Guava', category_name: 'Fruits', brand_name: 'Tropical Bliss', price: 2.99, image_url: 'https://example.com/guava.jpg' },
    { item_name: 'Kale', category_name: 'Vegetables', brand_name: 'Green Health', price: 2.49, image_url: 'https://example.com/kale.jpg' },
    { item_name: 'Energy Drink', category_name: 'Beverages', brand_name: 'BoostUp', price: 2.99, image_url: 'https://example.com/energydrink.jpg' },
    { item_name: 'Lobster', category_name: 'Seafood', brand_name: 'Ocean Treasures', price: 18.99, image_url: 'https://example.com/lobster.jpg' },
    { item_name: 'Rosemary', category_name: 'Herbs', brand_name: 'Aroma Herbs', price: 1.99, image_url: 'https://example.com/rosemary.jpg' },
    { item_name: 'Coconut Milk', category_name: 'Dairy', brand_name: 'Tropical Dairy', price: 3.49, image_url: 'https://example.com/coconutmilk.jpg' },
    { item_name: 'Cherries', category_name: 'Fruits', brand_name: 'Cherry Top', price: 4.99, image_url: 'https://example.com/cherries.jpg' },
    { item_name: 'Turmeric Powder', category_name: 'Spices', brand_name: 'Golden Spices', price: 2.49, image_url: 'https://example.com/turmeric.jpg' },
    { item_name: 'Whole Chicken', category_name: 'Meat', brand_name: 'Farmhouse', price: 9.99, image_url: 'https://example.com/wholechicken.jpg' },
    { item_name: 'Cabbage', category_name: 'Vegetables', brand_name: 'GreensVille', price: 2.49, image_url: 'https://example.com/cabbage.jpg' },
    { item_name: 'Vitamin C Tablets', category_name: 'Health Supplements', brand_name: 'HealthFirst', price: 4.99, image_url: 'https://example.com/vitaminc.jpg' },
    { item_name: 'Almond Butter', category_name: 'Pantry', brand_name: 'Nutty Spread', price: 5.49, image_url: 'https://example.com/almondbutter.jpg' },
    { item_name: 'Pesto Sauce', category_name: 'Pantry', brand_name: 'Italiano Delight', price: 4.49, image_url: 'https://example.com/pesto.jpg' },
    { item_name: 'Oatmeal Cookies', category_name: 'Snacks', brand_name: 'Tasty Bites', price: 3.99, image_url: 'https://example.com/oatmealcookies.jpg' },
    { item_name: 'Brussels Sprouts', category_name: 'Vegetables', brand_name: 'Healthy Greens', price: 2.99, image_url: 'https://example.com/brusselssprouts.jpg' },
    { item_name: 'Thyme', category_name: 'Herbs', brand_name: 'Aromatic Farms', price: 1.99, image_url: 'https://example.com/thyme.jpg' },
    { item_name: 'Cod Fish', category_name: 'Seafood', brand_name: 'Deep Blue', price: 7.99, image_url: 'https://example.com/codfish.jpg' }
  ]);

  console.log("Data seeded!");
}

async function fetchData() {
    const items = await Item.find();
    console.log("Items from the database:");
    console.log(items);
}

async function seedAndFetchData() {
    await seedData();
    await fetchData();
    mongoose.connection.close(); 
}

seedAndFetchData();
*/
