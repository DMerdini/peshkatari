-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 05:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peshkatari_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_image` varchar(1000) NOT NULL,
  `prod_descr` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` double(10,1) NOT NULL,
  `prod_cat` varchar(255) NOT NULL,
  `prod_ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`prod_ingredients`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_image`, `prod_descr`, `prod_name`, `prod_price`, `prod_cat`, `prod_ingredients`) VALUES
(2, 'https://www.marthastewart.com/thmb/S9xVtnWSHldvxPHKOxEq0bALG-k=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/MSL-338686-spaghetti-carbonara-hero-3x2-69999-560b45d1dd9f4741b717176eff024839.jpeg', 'The classic Roman pasta dish with a creamy, rich sauce, perfect for a quick and satisfying meal.', 'Spaghetti Carbonara', 14.0, 'Pasta', '[\"Spaghetti\",\"Guanciale\",\"Pecorino Romano\",\"Egg Yolk\",\"Black Pepper\"]'),
(3, 'https://www.tallutos.com/images/com_joomrecipe/860/cropped-20240925095446-IMG.8289.JPG', 'A simple but intensely flavorful Roman dish with just cheese and pepper, emulsified to perfection.', 'Cacio e Pepe', 12.0, 'Pasta', '[\"Spaghetti\",\"Pecorino Romano\",\"Black Pepper\"]'),
(4, 'https://i0.wp.com/smittenkitchen.com/wp-content/uploads/2012/02/lasagna-bolognese-4-scaled.jpg?fit=1200%2C800&ssl=1', 'Layers of fresh egg pasta, rich meat ragù, creamy bechamel, and Parmigiano cheese, baked until golden.', 'Lasagne alla Bolognese', 16.5, 'Pasta', '[\"Lasagne Sheets\",\"Ragù\",\"Béchamel\",\"Parmigiano Reggiano\"]'),
(5, 'https://cookingmydreams.com/wp-content/uploads/2018/02/Trofie-al-Pesto-new-2.jpg', 'Fresh Ligurian basil pesto with pine nuts, garlic, and cheese, tossed with traditional spiral pasta.', 'Trofie al Pesto', 13.0, 'Pasta', '[\"Trofie\",\"Basil Pesto\",\"Potatoes\",\"Green Beans\",\"Pine Nuts\"]'),
(6, 'https://www.cucchiaio.it/content/cucchiaio/it/ricette/2009/12/ricetta-gnocchi-patate-pomodoro-basilico/jcr:content/header-par/image_single.img.jpg/1576595877645.jpg', 'Light, pillowy potato dumplings served in a classic, vibrant tomato sauce with fresh basil.', 'Gnocchi al Pomodoro', 12.5, 'Pasta', '[\"Gnocchi\",\"Tomato Sauce\",\"Fresh Basil\",\"Parmigiano\"]'),
(7, 'https://assets.bonappetit.com/photos/6631642a768e98647bcb9e34/1:1/w_3237,h_3237,c_limit/amatriciana_RECIPE_041624_0739_VOG_final.jpg', 'Spicy, savory pasta with cured pork cheek, Pecorino cheese, and a hint of tomato sauce.', 'Bucatini all\'Amatriciana', 14.5, 'Pasta', '[\"Bucatini\",\"Guanciale\",\"Tomato\",\"Pecorino Romano\",\"Chilli\"]'),
(8, 'https://www.cucchiaio.it/content/cucchiaio/it/ricette/2017/01/spaghetti-vongole/jcr:content/header-par/image-single.img10.jpg/1671099613022.jpg', 'A light, Neapolitan seafood pasta with clams, garlic, olive oil, and a touch of white wine.', 'Spaghetti alle Vongole', 17.5, 'Pasta', '[\"Spaghetti\",\"Clams\",\"Garlic\",\"White Wine\",\"Parsley\"]'),
(9, 'https://www.giallozafferano.com/images/260-26061/Penne-all-arrabbiata_1200x800.jpg', 'A fiery Roman classic: penne tossed in a spicy tomato sauce with garlic and red chili peppers.', 'Penne all\'Arrabbiata', 11.5, 'Pasta', '[\"Penne\",\"Tomato Sauce\",\"Garlic\",\"Chilli Pepper\",\"Parsley\"]'),
(10, 'https://uk.ooni.com/cdn/shop/articles/20220211142645-margherita-9920_e41233d5-dcec-461c-b07e-03245f031dfe.jpg?v=1737105431&width=1080', 'The ultimate classic, showcasing the colours of the Italian flag with simple, high-quality ingredients.', 'Pizza Margherita', 10.0, 'Pizza', '[\"Tomato Sauce\",\"Mozzarella\",\"Fresh Basil\",\"Olive Oil\"]'),
(11, 'https://www.moulinex-me.com/medias/?context=bWFzdGVyfHJvb3R8MTQzNTExfGltYWdlL2pwZWd8YUdObEwyaG1aQzh4TlRrMk9EWXlOVGM0TmpreE1DNXFjR2N8MmYwYzQ4YTg0MTgzNmVjYTZkMWZkZWZmMDdlMWFlMjRhOGIxMTQ2MTZkNDk4ZDU3ZjlkNDk2MzMzNDA5OWY3OA', 'A popular American-Italian style pizza with spicy cured meat and extra cheese.', 'Pizza Pepperoni', 12.5, 'Pizza', '[\"Tomato Sauce\",\"Mozzarella\",\"Pepperoni\"]'),
(12, 'https://www.giallozafferano.com/images/293-29343/pizza-capricciosa_650x433_wm.jpg', 'A rich and hearty pizza with ham, mushrooms, artichokes, and olives.', 'Pizza Capricciosa', 13.5, 'Pizza', '[\"Tomato Sauce\",\"Mozzarella\",\"Ham\",\"Mushrooms\",\"Artichokes\",\"Olives\"]'),
(13, 'https://grandecheese.com/wp-content/uploads/2025/02/QuattroFormaggiPizza.jpg', 'A decadent pizza topped with a blend of four distinct cheeses, usually including mozzarella and Gorgonzola.', 'Pizza Quattro Formaggi', 14.0, 'Pizza', '[\"Mozzarella\",\"Gorgonzola\",\"Parmesan\",\"Stracchino\"]'),
(14, 'https://www.negroni.com/sites/default/files/styles/scale__1440_x_1440_/public/pizza_rustica.jpg.webp?itok=yOfpO3mx', 'A spicy favorite with mozzarella, tomato, and slices of hot salami.', 'Pizza Diavola', 12.0, 'Pizza', '[\"Tomato Sauce\",\"Mozzarella\",\"Spicy Salami\",\"Chilli\"]'),
(15, 'https://www.lucake.it/wp-content/uploads/2022/10/torta-tiramisu.jpg', 'A world-famous Italian dessert with layers of coffee-soaked ladyfingers and sweet mascarpone cream.', 'Tiramisù', 7.5, 'Dessert', '[\"Ladyfingers\",\"Mascarpone\",\"Espresso\",\"Eggs\",\"Cocoa Powder\"]'),
(16, 'https://static01.nyt.com/images/2023/08/10/multimedia/LH-Panna-Cotta-wczm/LH-Panna-Cotta-wczm-mediumSquareAt3X.jpg', 'A smooth, molded, and chilled Italian dessert, typically topped with a fruit sauce or caramel.', 'Panna Cotta', 6.5, 'Dessert', '[\"Cream\",\"Sugar\",\"Gelatin\",\"Vanilla\",\"Caramel Sauce\"]'),
(17, 'https://blog.giallozafferano.it/fantasiaincucina/wp-content/uploads/2020/12/Cannolo-siciliano-960x620.jpg', 'Crispy fried pastry shells filled with a sweet, creamy ricotta filling, often mixed with candied fruit or chocolate chips.', 'Cannoli Siciliani', 8.0, 'Dessert', '[\"Fried Pastry Shell\",\"Ricotta Cheese\",\"Sugar\",\"Candied Fruit\"]'),
(18, 'https://beinspired.au/wp-content/uploads/2023/11/Antipasto-Insalata-Caprese.jpeg', 'A simple, fresh Italian salad, representing the colours of the Italian flag.', 'Insalata Caprese', 9.0, 'Salad', '[\"Fresh Mozzarella\",\"Tomatoes\",\"Fresh Basil\",\"Olive Oil\"]'),
(19, 'https://insanelygoodrecipes.com/wp-content/uploads/2024/09/minestrone-soup.jpg', 'A thick, hearty Italian vegetable soup, often including pasta or rice.', 'Minestrone Soup', 8.5, 'Soup', '[\"Vegetables (Seasonal)\",\"Beans\",\"Pasta/Rice\",\"Broth\"]'),
(20, 'https://healthyfitnessmeals.com/wp-content/uploads/2020/05/instagram-In-Stream_Square___Low-carb-Caesar-salad-4.jpg', 'A classic salad with romaine lettuce, croutons, Parmesan, and a signature dressing.', 'Chicken Caesar Salad', 11.0, 'Salad', '[\"Romaine Lettuce\",\"Grilled Chicken\",\"Croutons\",\"Parmesan\",\"Caesar Dressing\"]'),
(21, 'https://www.allrecipes.com/thmb/PKh_MtthZMtG1flNmud0MNgRK7w=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg', 'A velvety smooth soup, perfect as a starter or light meal.', 'Cream of Mushroom Soup', 7.0, 'Soup', '[\"Mushrooms\",\"Cream\",\"Butter\",\"Onion\",\"Broth\"]');

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `userorder_id` int(11) NOT NULL,
  `userorder_userid` int(11) NOT NULL,
  `userorder_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`userorder_data`)),
  `userorder_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userorder_status` varchar(50) DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`userorder_id`, `userorder_userid`, `userorder_data`, `userorder_time`, `userorder_status`) VALUES
(1, 0, '[{\r\n        \"prod_id\": \"2\",\r\n        \"prod_image\": \"https://www.marthastewart.com/thmb/S9xVtnWSHldvxPHKOxEq0bALG-k=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/MSL-338686-spaghetti-carbonara-hero-3x2-69999-560b45d1dd9f4741b717176eff024839.jpeg\",\r\n        \"prod_descr\": \"The classic Roman pasta dish with a creamy, rich sauce, perfect for a quick and satisfying meal.\",\r\n        \"prod_name\": \"Spaghetti Carbonara\",\r\n        \"prod_price\": \"14.0\",\r\n        \"prod_cat\": \"Pasta\"\r\n    }]', '2025-11-26 15:18:15', 'processing'),
(2, 5, '[{\"prod_id\":19,\"prod_image\":\"https:\\/\\/insanelygoodrecipes.com\\/wp-content\\/uploads\\/2024\\/09\\/minestrone-soup.jpg\",\"prod_descr\":\"A thick, hearty Italian vegetable soup, often including pasta or rice.\",\"prod_name\":\"Minestrone Soup\",\"prod_price\":8.5,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 15:50:13', 'processing'),
(3, 5, '[{\"prod_id\":7,\"prod_image\":\"https:\\/\\/assets.bonappetit.com\\/photos\\/6631642a768e98647bcb9e34\\/1:1\\/w_3237,h_3237,c_limit\\/amatriciana_RECIPE_041624_0739_VOG_final.jpg\",\"prod_descr\":\"Spicy, savory pasta with cured pork cheek, Pecorino cheese, and a hint of tomato sauce.\",\"prod_name\":\"Bucatini all\'Amatriciana\",\"prod_price\":14.5,\"prod_cat\":\"Pasta\",\"quantity\":1},{\"prod_id\":8,\"prod_image\":\"https:\\/\\/www.cucchiaio.it\\/content\\/cucchiaio\\/it\\/ricette\\/2017\\/01\\/spaghetti-vongole\\/jcr:content\\/header-par\\/image-single.img10.jpg\\/1671099613022.jpg\",\"prod_descr\":\"A light, Neapolitan seafood pasta with clams, garlic, olive oil, and a touch of white wine.\",\"prod_name\":\"Spaghetti alle Vongole\",\"prod_price\":17.5,\"prod_cat\":\"Pasta\",\"quantity\":1},{\"prod_id\":9,\"prod_image\":\"https:\\/\\/www.giallozafferano.com\\/images\\/260-26061\\/Penne-all-arrabbiata_1200x800.jpg\",\"prod_descr\":\"A fiery Roman classic: penne tossed in a spicy tomato sauce with garlic and red chili peppers.\",\"prod_name\":\"Penne all\'Arrabbiata\",\"prod_price\":11.5,\"prod_cat\":\"Pasta\",\"quantity\":1},{\"prod_id\":18,\"prod_image\":\"https:\\/\\/beinspired.au\\/wp-content\\/uploads\\/2023\\/11\\/Antipasto-Insalata-Caprese.jpeg\",\"prod_descr\":\"A simple, fresh Italian salad, representing the colours of the Italian flag.\",\"prod_name\":\"Insalata Caprese\",\"prod_price\":9,\"prod_cat\":\"Salad\",\"quantity\":1},{\"prod_id\":20,\"prod_image\":\"https:\\/\\/healthyfitnessmeals.com\\/wp-content\\/uploads\\/2020\\/05\\/instagram-In-Stream_Square___Low-carb-Caesar-salad-4.jpg\",\"prod_descr\":\"A classic salad with romaine lettuce, croutons, Parmesan, and a signature dressing.\",\"prod_name\":\"Chicken Caesar Salad\",\"prod_price\":11,\"prod_cat\":\"Salad\",\"quantity\":1},{\"prod_id\":21,\"prod_image\":\"https:\\/\\/www.allrecipes.com\\/thmb\\/PKh_MtthZMtG1flNmud0MNgRK7w=\\/1500x0\\/filters:no_upscale():max_bytes(150000):strip_icc()\\/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg\",\"prod_descr\":\"A velvety smooth soup, perfect as a starter or light meal.\",\"prod_name\":\"Cream of Mushroom Soup\",\"prod_price\":7,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 15:55:36', 'processing'),
(4, 1, '[{\"prod_id\":13,\"prod_image\":\"https:\\/\\/grandecheese.com\\/wp-content\\/uploads\\/2025\\/02\\/QuattroFormaggiPizza.jpg\",\"prod_descr\":\"A decadent pizza topped with a blend of four distinct cheeses, usually including mozzarella and Gorgonzola.\",\"prod_name\":\"Pizza Quattro Formaggi\",\"prod_price\":14,\"prod_cat\":\"Pizza\",\"quantity\":1},{\"prod_id\":18,\"prod_image\":\"https:\\/\\/beinspired.au\\/wp-content\\/uploads\\/2023\\/11\\/Antipasto-Insalata-Caprese.jpeg\",\"prod_descr\":\"A simple, fresh Italian salad, representing the colours of the Italian flag.\",\"prod_name\":\"Insalata Caprese\",\"prod_price\":9,\"prod_cat\":\"Salad\",\"quantity\":1},{\"prod_id\":19,\"prod_image\":\"https:\\/\\/insanelygoodrecipes.com\\/wp-content\\/uploads\\/2024\\/09\\/minestrone-soup.jpg\",\"prod_descr\":\"A thick, hearty Italian vegetable soup, often including pasta or rice.\",\"prod_name\":\"Minestrone Soup\",\"prod_price\":8.5,\"prod_cat\":\"Soup\",\"quantity\":1},{\"prod_id\":20,\"prod_image\":\"https:\\/\\/healthyfitnessmeals.com\\/wp-content\\/uploads\\/2020\\/05\\/instagram-In-Stream_Square___Low-carb-Caesar-salad-4.jpg\",\"prod_descr\":\"A classic salad with romaine lettuce, croutons, Parmesan, and a signature dressing.\",\"prod_name\":\"Chicken Caesar Salad\",\"prod_price\":11,\"prod_cat\":\"Salad\",\"quantity\":1}]', '2025-11-26 16:47:36', 'processing'),
(5, 1, '[{\"prod_id\":21,\"prod_image\":\"https:\\/\\/www.allrecipes.com\\/thmb\\/PKh_MtthZMtG1flNmud0MNgRK7w=\\/1500x0\\/filters:no_upscale():max_bytes(150000):strip_icc()\\/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg\",\"prod_descr\":\"A velvety smooth soup, perfect as a starter or light meal.\",\"prod_name\":\"Cream of Mushroom Soup\",\"prod_price\":7,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 16:50:09', 'processing'),
(6, 1, '[{\"prod_id\":21,\"prod_image\":\"https:\\/\\/www.allrecipes.com\\/thmb\\/PKh_MtthZMtG1flNmud0MNgRK7w=\\/1500x0\\/filters:no_upscale():max_bytes(150000):strip_icc()\\/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg\",\"prod_descr\":\"A velvety smooth soup, perfect as a starter or light meal.\",\"prod_name\":\"Cream of Mushroom Soup\",\"prod_price\":7,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 16:50:26', 'processing'),
(7, 1, '[{\"prod_id\":21,\"prod_image\":\"https:\\/\\/www.allrecipes.com\\/thmb\\/PKh_MtthZMtG1flNmud0MNgRK7w=\\/1500x0\\/filters:no_upscale():max_bytes(150000):strip_icc()\\/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg\",\"prod_descr\":\"A velvety smooth soup, perfect as a starter or light meal.\",\"prod_name\":\"Cream of Mushroom Soup\",\"prod_price\":7,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 16:51:01', 'processing'),
(8, 1, '[{\"prod_id\":21,\"prod_image\":\"https:\\/\\/www.allrecipes.com\\/thmb\\/PKh_MtthZMtG1flNmud0MNgRK7w=\\/1500x0\\/filters:no_upscale():max_bytes(150000):strip_icc()\\/13096-Cream-of-Mushroom-Soup-ddmfs-4x3-293-b505e37374d74e81807e8a93bcdd7bab.jpg\",\"prod_descr\":\"A velvety smooth soup, perfect as a starter or light meal.\",\"prod_name\":\"Cream of Mushroom Soup\",\"prod_price\":7,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 16:51:52', 'processing'),
(9, 1, '[{\"prod_id\":19,\"prod_image\":\"https:\\/\\/insanelygoodrecipes.com\\/wp-content\\/uploads\\/2024\\/09\\/minestrone-soup.jpg\",\"prod_descr\":\"A thick, hearty Italian vegetable soup, often including pasta or rice.\",\"prod_name\":\"Minestrone Soup\",\"prod_price\":8.5,\"prod_cat\":\"Soup\",\"quantity\":1}]', '2025-11-26 16:52:04', 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `user_pic` varchar(2000) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_password`, `user_pic`, `user_username`, `user_status`) VALUES
(1, 'Pablo', 'Picasso', 'pp@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'pablo', 1),
(2, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 0),
(3, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 0),
(4, '', '', 'victor@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'victor', 0),
(5, '', '', 'elgreco@gmail.com', '202cb962ac59075b964b07152d234b70', '', 'el', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `prod_image` varchar(1000) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `prod_image`, `prod_price`, `prod_name`) VALUES
(2, '1', '5', '', 0.00, ''),
(3, '4', '3', '', 0.00, ''),
(5, '4', '4', '', 0.00, ''),
(6, '', '4', '', 0.00, ''),
(7, '1', '4', '', 0.00, ''),
(19, '1', '3', 'https://www.tallutos.com/images/com_joomrecipe/860/cropped-20240925095446-IMG.8289.JPG', 12.00, 'Cacio e Pepe'),
(20, '5', '3', 'https://www.tallutos.com/images/com_joomrecipe/860/cropped-20240925095446-IMG.8289.JPG', 12.00, 'Cacio e Pepe'),
(21, '5', '4', 'https://i0.wp.com/smittenkitchen.com/wp-content/uploads/2012/02/lasagna-bolognese-4-scaled.jpg?fit=1200%2C800&ssl=1', 16.50, 'Lasagne alla Bolognese');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`userorder_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `userorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
