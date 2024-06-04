<div class="grid min-h-screen place-items-center">
    <nav>
        <ul class="mt-10">
            <?php
            if (count($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <li class="text-black"><?php echo $error; ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
        <h1 class="text-xl font-semibold">アカウント登録</h1>
        <form class="mt-6" action="/acount" method="post" enctype="multipart/form-data">
            <label for="name" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">名前</label>
            <input id="name" type="text" name="name" placeholder="名無しの権兵衛" autocomplete="name" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" value="<?php echo isset($user['name']) ? $user['name'] : '' ?>" required />
            <label for="email" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">E-mail</label>
            <input id="email" type="email" name="email" placeholder="john.doe@company.com" autocomplete="email" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" required />
            <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
            <input id="password" type="password" name="password" placeholder="********" autocomplete="new-password" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"  required />
            <label for="password-confirm" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Confirm password</label>
            <input id="password-confirm" type="password" name="password-confirm" placeholder="********" autocomplete="new-password" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                登録
            </button>
        </form>
    </div>
</div>
