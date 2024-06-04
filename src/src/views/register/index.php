<?php
$user = [];
$user['name'] = [];
$imagePath = '/var/www/html/src/imgs/mount.jpg';
$binaryData = file_get_contents($imagePath);
$base64Data = base64_encode($binaryData);

// MIMEタイプの取得
$mimeType = mime_content_type($imagePath);

// Base64エンコードされたデータを含むデータURIを生成
$dataUri = 'data:' . $mimeType . ';base64,' . $base64Data;

// HTMLを出力して画像を表示
?>


<main>
  <div class="flex" style="background-image: url('<?php echo $this->createPath('/var/www/html/src/imgs/mount.jpg') ?>')">
    <section class="bg-black dark:bg-gray-900 w-2/6 mx-auto">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-white dark:text-white">
          新しい所持品
        </a>
        <nav>
          <ul class="list-disc">
            <?php if (count($errors)) : ?>
              <?php foreach ($errors as $error) : ?>
                <li class="text-white"><?php echo $error; ?></li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </nav>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 p-4 dark:bg-gray-800 dark:border-black">
          <form class="space-y-4 md:space-y-6" action="/register" method="post" enctype="multipart/form-data">
            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="名前を入力" required="">
            </div>
            <div>
              <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">場所</label>
              <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="場所を入力" required="">
            </div>
            <div class="mb-4">
              <label for="category" class="block text-sm font-medium text-gray-600">カテゴリー</label>
              <select id="category" name="category" class="mt-1 p-2 border rounded w-full">
                <!-- デフォルトの選択肢 -->
                <option value="" disabled selected>カテゴリーを選択してください</option>
                <!-- カテゴリー1 -->
                <option value="category1">カテゴリー1</option>
                <!-- カテゴリー2 -->
                <option value="category2">カテゴリー2</option>
                <!-- カテゴリー3 -->
                <option value="category3">カテゴリー3</option>
                <!-- 他のカテゴリーを追加 -->
              </select>
            </div>
            <div>
              <label for="other" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">その他</label>
              <textarea rows="4" cols="50" name="other" id="other" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" />
              </textarea>
            </div>
            <div>
              <div class="mb-3">
                <label for="image">Image picture</label>
              </div>
              <input type="file" name="image" required>
              <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
            </div>
            <div class="text-center">
              <button type="submit" class="w-1/2 text-white bg-black hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                所持品の登録
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
