import { Product } from './product';

export const PRODUCTS: Product[] = [
    {
        id: 1,
        team: "Liverpool",
        state: "Domicile",
        picture: "https://lorem.picsum/60/60",
        price: 50,
        types: ["Ligue des Champions"],
        created: new Date()
    },
    {
        id: 2,
        team: "Real Madrid",
        state: "Extérieur",
        picture: "https://lorem.picsum/60/60",
        price: 50,
        types: ["Ligue des Champions"],
        created: new Date()
    },
    {
        id: 3,
        team: "France",
        state: "Domicile",
        picture: "https://lorem.picsum/60/60",
        price: 50,
        types: ["Euro 2020"],
        created: new Date()
    },
    {
        id: 4,
        team: "Espagne",
        state: "Extérieur",
        picture: "https://lorem.picsum/60/60",
        price: 50,
        types: ["Euro 2020"],
        created: new Date()
    },
    {
        id: 5,
        team: "Bayern Munich",
        state: "Extérieur",
        picture: "https://lorem.picsum/60/60",
        price: 50,
        types: ["Ligue des Champions"],
        created: new Date()
    }
]