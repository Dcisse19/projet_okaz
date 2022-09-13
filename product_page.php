<?php
require_once './includes/header.php';
require_once './src/ProductModel.php';
require_once './src/StoreModel.php';
require_once './src/CartModel.php';
$productmodel = new ProductModel();
$cartmodel = new CartModel();
$product = $productmodel->getOneProduct();
$storemodel = new StoreModel();
$store = $storemodel->getStoreByProduct();
$error = $cartmodel->addToCart($product->getId());
$products = $productmodel->getProducts();

// $title = 'Les tables'; // change selon l'id de la catégorie
// $subTitle = "Trouvez votre bonheur en parcourant notre catalogue de tables d'occasion"; // change selon l'id de la catégorie
// require_once './includes/title.php';
?>

<!-- Contenu de la page -->
<section class="bg-white p-36">
    <div class="container mx-auto">

        <!-- Présentation produit -->
        <div class="px-28">
            <div class="flex flex-col justify-center space-y-10 mb-20">
                <h2 class="text-center text-4xl text-darkblue font-semibold uppercase"><?= $product->getName() ?></h2>
                <?php if (isset($error) && !empty($error["errorProduct_exist"])) { ?>
                    <p class="text-red-500 text-center text-xl"><?= $error["errorProduct_exist"] ?></p>
                <?php }  ?>
            </div>
            <img class="h-[300px] w-[450px] block m-auto" src="<?= $product->getImage() ?>" alt="<?= $product->getName() ?>">
            <hr class="block mx-auto border-darkgrey border-t-0 border-b-2 my-14" />
            <!-- Description produit -->
            <div class="flex justify-between mb-16">
                <div class="flex flex-col items-start">
                    <!-- Description -->
                    <p class="mb-10 text-lg"><span class="font-bold text-xl mb-2">Description : </span><br /><?= $product->getDescription() ?></p>
                    <p class="text-lg"> <span class="font-bold">Etat : </span><?= $product->getProduct_condition() ?></p>
                    <p class="text-lg"> <span class="font-bold">Dimensions : </span><?= $product->getDimensions() ?></p>
                    <p class="text-lg"> <span class="font-bold">Couleur : </span><?= $product->getColor() ?></p>
                </div>

                <p class="text-right text-orange text-3xl font-bold"><?= number_format($product->getPrice(), 2, ',', ' '); ?>€</p>
            </div>

            <div class="flex space-x-10 justify-center ">
                <form action="" method="POST">
                    <div class=" bg-orange hover-bg-darkgrey w-fit rounded-full py-2 px-6 mb-6 block m-auto">
                        <button class="text-white text-center text-lg font-semibold tracking-wide">Ajouter au panier</button>
                    </div>
                </form>
                <!-- <a href="cart.php">
                    <div class=" bg-orange hover-bg-darkgrey w-fit rounded-full py-2 px-6 mb-6 block m-auto">
                        <button class="text-white text-center text-lg font-semibold tracking-wide">Ajouter au panier</button>
                    </div>
                </a> -->
                <a id="storeLink" href="#" data-bs-toggle="modal">
                    <div class=" bg-blue hover-bg-darkgrey w-fit rounded-full py-2 px-4 mb-14 block m-auto">
                        <button href="#" class="text-white text-center text-lg font-semibold tracking-wide">Acheter en magasin</button>
                    </div>
                </a>
            </div>
            <hr class="block mx-auto border-darkgrey border-t-0 border-b-2 my-10 " />
        </div>

        <!-- Carroussel -->
        <!-- Implement the carousel 
        <div class="js-product-carousel flex space-x-3 justify-between mx-auto items-center">

            Previous button 
            <a class="js-carousel-prev">
                <div class="rounded-full bg-orange hover-bg-darkgrey py-3 px-5">
                    <i class="fas fa-regular fa-angle-left fa-2x"></i>
                </div>
            </a>
            <div class="js-product-list flex space-x-3 mx-auto items-center">
                <?php //foreach ($products as $product_two) { 
                ?>
                    <div class="slide w-[200px] product">
                        <img class="w-full h-[150px]" src="<?php // $product_two->getImage() 
                                                            ?>">
                        <a href="product_page.php?id=<?php // $product_two->getId() 
                                                        ?>">
                            <div class="w-full px-5 py-3 bg-zinc-600 hover:bg-zinc-800 text-center text-white"><?php // $product_two->getName() 
                                                                                                                ?></div>
                        </a>
                    </div>
                <?php //} 
                ?>
            </div>
            Next button 
            <a class="js-carousel-next">
                <div class="rounded-full bg-blue hover-bg-darkgrey py-3 px-5">
                    <i class="fas fa-regular fa-angle-right fa-2x"></i>
                </div>
            </a>
        </div> -- > -->

        <div class=" flex justify-between mx-auto items-center">
            <a id = "buttonprev" onclick="moveSlide(-1)">
                <div class="rounded-full bg-orange hover-bg-darkgrey py-3 px-5">
                    <i class="fas fa-regular fa-angle-left fa-2x"></i>
                </div>
            </a>
            <div class="flex space-x-3 mx-auto items-center">
                <?php foreach ($products as $product) { ?>
                    <div class="w-[200px] slide">
                        <img class="w-full h-[150px]" src="<?= $product->getImage() ?>">
                        <a href="product_page.php?id=<?= $product->getId() ?>">
                            <div class="w-full px-5 py-3 bg-zinc-600 hover:bg-zinc-800 text-center text-white"><?= $product->getName() ?></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Next button -->
            <a id = "buttonnext" onclick="moveSlide(1)">
                <div class="rounded-full bg-blue hover-bg-darkgrey py-3 px-5">
                    <i class="fas fa-regular fa-angle-right fa-2x"></i>
                </div>
            </a>
        </div>
        <!-- <div class="h-[300px] js-product-carousel">
            <div class="carousel__view">
                <span class="carousel__control js-carousel-prev"><i class="icon">previous</i></span>
                <span href="#" class="carousel__control js-carousel-next"><i class="icon">next</i></span>
                <ul class="product-list js-product-list">
                    <li class="product-list__item">
                        <div data-slide="1" class="product">
                            <img src="https://images.unsplash.com/photo-1487600849525-7d8eccadd679?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjF8fGNhYmluZXR8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60" alt="">
                        </div>
                    </li>
                    <li class="product-list__item">
                        <div data-slide="2" class="product">
                            <img src="https://media.istockphoto.com/photos/old-coffee-table-picture-id525954841?k=20&m=525954841&s=612x612&w=0&h=eVjoqEw6aoNbcwxmx6UbmHmiKUkzFhWU0JdSZXUCCqk=" alt="">
                        </div>
                    </li>
                    <li class="product-list__item">
                        <div data-slide="3" class="product">
                            <img src="https://images.unsplash.com/photo-1602145461313-26c587cc0ca9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzV8fGxhbXB8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60" alt="">
                        </div>
                    </li>
                    <li class="product-list__item">
                        <div data-slide="4" class="product">
                            <img src="https://images.unsplash.com/photo-1543512214-4f76e81f8bfc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzZ8fGxhbXB8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60" alt="">
                        </div>
                    </li>
                    <li class="product-list__item">
                        <div data-slide="5" class="product">
                            <img src="https://images.unsplash.com/photo-1543512214-4f76e81f8bfc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzZ8fGxhbXB8ZW58MHx8MHx8&auto=format&fit=crop&w=600&q=60" alt="">
                        </div>
                    </li>
                </ul>
            </div>
        </div> -->
    </div>
</section>
<!-- <div class="container mx-auto p-6 bg-eggshell mt-20">
    <h3 class="text-3xl font-semibold text-darkblue mb-10 text-center">Dans la même catégorie</h3>
    <div class="flex items-center space-x-6">
        <div class="slide flex items-center space-x-6">
            <div class="bg-white p-5 rounded-lg">
                <img class="h-[150px] w-[220px] mb-3" src=" https://media.istockphoto.com/photos/old-coffee-table-picture-id525954841?k=20&m=525954841&s=612x612&w=0&h=eVjoqEw6aoNbcwxmx6UbmHmiKUkzFhWU0JdSZXUCCqk=" alt="Table_basse_style_scandinave">
                <p class="text-lg font-semibold text-center">Table basse style scandinave</p>
                <p class="text-lg font-bold text-center">59,80€</p>
            </div>

            <div class="bg-white p-5 rounded-lg">
                <img class="h-[150px] w-[220px] mb-3" src=" https://media.istockphoto.com/photos/stylish-bright-yellow-chair-chair-in-room-with-ears-and-armrest-picture-id1304184858?k=20&m=1304184858&s=612x612&w=0&h=EK2mwhWbCMMU8WxCoi9cb5BZS-bFzy8QpdYxLhclsE0=" alt="Table_basse_style_scandinave">
                <p class="text-lg font-semibold text-center">Table basse style scandinave</p>
                <p class="text-lg font-bold text-center">59,80€</p>
            </div>

            <div class="bg-white p-5 rounded-lg">
                <img class="h-[150px] w-[220px] mb-3" src=" https://i.ibb.co/Wn754t5/buffet.jpg" alt="Table_basse_style_scandinave">
                <p class="text-lg font-semibold text-center">Table basse style scandinave</p>
                <p class="text-lg font-bold text-center">59,80€</p>
            </div>

            <div class="bg-white p-5 rounded-lg">
                <img class="h-[150px] w-[220px] mb-3" src=" https://i.ibb.co/Wn754t5/buffet.jpg" alt="Table_basse_style_scandinave">
                <p class="text-lg font-semibold text-center">Table basse style scandinave</p>
                <p class="text-lg font-bold text-center">59,80€</p>
            </div>
        </div>

        <button onclick="moveSlide(1)">
            <i class="ml-3 fas fa-regular fa-chevron-right fa-3x text-orange"></i>
        </button>
    </div>
</div> -->

<!-- Modale produit disponible dans magasin -->
<section id="storeModal" class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative container mx-auto top-28 w-1/2 bg-white p-10">
        <!-- <div class="container p-10"> -->
        <button class="rounded p-2 bg-blue hover-bg-darkgrey float-right">
            <i id="closeStoreModal" class="fa-solid fa-xmark fa-xl"></i>
        </button>
        <h3 class="text-darkblue text-2xl text-center mb-10"> Votre produit : <span class="font-semibold">"<?= $store["name"] ?>"</span> <br /> est disponible dans votre magasin :</h3>
        <div class="flex flex-col gap-y-4">
            <h3 class="text-orange text-2xl font-semibold uppercase"><?= $store["store_name"] ?></h3>
            <p class="text-lg"> <span class="font-bold">Adresse : </span><?= $store["store_address"] . ", " . $store["store_postal_code"] . " " . $store["store_city"] ?></p>
            <p class="text-lg"> <span class="font-bold">Téléphone : </span><?= $store["store_telephone"] ?></p>
            <p class="text-lg"> <span class="font-bold">Horaires d'ouverture : </span>
                <br />Du Lundi au Vendredi : de 10h à 18h
                <br />Samedi : de 9h30 à 19h
                <br />Dimanche : Fermé
            </p>
        </div>
        <!-- </div> -->
    </div>
</section>
<script src="./JS/product_page.js"></script>

<?php require_once './includes/footer.php'; ?>