
## Unlimited nesting comments

 - Clone project: 
 ```
 git clone https://github.com/Finnesko7/solar-digital.git .
```
- Install all packages for Laravel:
 ```
 composer install
```

- Execute migration:
 ```
 php artisan migrate
```

- Execute seeds:
 ```
 php artisan db:seed
```

- Execute tests:
 ```
 composer test
```

When deploying the project, you can choose one of the posts, by selecting which you can leave your comment.
To insert a nested comment, just click on "Leave a comment", then enter the text, then just click in an empty space. After losing focus in the text field, the comment will be automatically added.
