<nav>
  <ul class="">
    <?php
    if (count($errors)) : ?>
      <?php foreach ($errors as $error) : ?>
        <li class="text-black"><?php echo $error; ?></li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</nav>
<main class="sm:flex items-center h-screen width-full p-4 mx-auto">
  <div class="sm:w-2/6 width-full">
    <form action="/login" method="post">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
          Email
        </label>
        <input class="shadow appearance-none border border-black rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" id="username" type="mail" name="email" placeholder="メールアドレス" />
        <?php if (isset($err['email'])) : ?>
          <p><?php echo $err['email']; ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="パスワード" />
      </div>
      <div class="text-center sm:text-start">
        <button class="bg-black hover:bg-blue-700 text-white mb-5 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          ログイン
        </button>
      </div>
      <input type="hidden" name="windowWidth" class="windowWidthInput">
      <input type="hidden" name="windowHeight" class="windowHeightInput">
    </form>
    <div class="text-center sm:text-start">
      <a href="/acount">
        <button class="bg-black hover:bg-blue-700 text-white  mb-5  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          新しいアカウントを作る
        </button>
      </a>
    </div>
  </div>
  <div class="mt-8 sm:m-0 sm:w-5/6 sm:ml-4">
    <img class="" src="<?php echo $this->createPath('/var/www/html/src/imgs/_70f80b3a-ebba-4301-b282-d658e291eaf2.jpg') ?>" alt="" />
  </div>
</main>
