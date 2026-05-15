//
// const a = [1,2,3]
// const b = [...a]

// a.push(4)
// console.log(a)
// console.log(b)

// const person1 = {
//     'name': 'igor',
//     'age': 20
// }

// const person2 = person1

// person1.name = 'ne igor'

// console.log(person1);
// console.log(person2);

const user = {
    email: "example@domain.com",
    username: 'tochnoneigor',
    password: 'asdasd'
}

const user2 = {...user, password: '123123'}

console.log(user2);
