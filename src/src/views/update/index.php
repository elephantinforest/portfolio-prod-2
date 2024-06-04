<div class="mx-4 md:mx-16 lg:mx-32">
  <form action="/update" method="POST" enctype="multipart/form-data" class="mt-32 max-w-screen-xl mx-auto">
    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-cyan-500 dark:text-white">登録アイテム</label>
        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $register['name']; ?>" required />
      </div>

      <div>
        <label for="genre" class="block mb-2 text-sm font-medium text-cyan-500 dark:text-white">ジャンル</label>
        <input type="text" name="genre" id="genre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $register['genre']; ?>" required />
      </div>

      <div>
        <label for="price" class="block mb-2 text-sm font-medium text-cyan-500 dark:text-white">値段</label>
        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $register['price']; ?>" required />
      </div>

      <div>
        <label for="location" class="block mb-2 text-sm font-medium text-cyan-500 dark:text-white">居所</label>
        <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $register['location']; ?>" required />
      </div>
    </div>

    <div class="grid grid-flow-col sm:justify-stretch justify-between h-60">
      <div class="w-auto md:w-64  ">
        <label for="dropzone-file" class="mb-2 text-sm font-medium text-cyan-500 dark:text-white">画像</label>
        <div class="flex items-center justify-center w-full h-40">
          <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            </div>
            <input id="dropzone-file" name="image_file" type="file" class="hidden" />
          </label>
        </div>
      </div>

      <div class="w-full md:w-auto">
        <label for="message" class="block mb-2 text-sm font-medium text-cyan-500 dark:text-white">その他</label>
        <textarea id="message" name="other" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 md:block"><?php echo $register['other']; ?></textarea>
      </div>
    </div>


    <input type="hidden" name="register_id" value="<?php echo $register['register_id']; ?>">
    <input type="hidden" name="location_id" value="<?php echo $register['location_id']; ?>">

    <button class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-64 h-24 font-mono hover:text-base mx-auto" type="submit">
      <span class="text-cyan-500">更新</span>
    </button>
  </form>
  <button class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-64 h-24 font-mono hover:text-base mx-auto mt-10" type="button">
    <a href="/update?location_id=<?php echo $register['location_id'] ?>">
      <span class="text-cyan-500">戻る</span>
    </a>
  </button>
</div>
