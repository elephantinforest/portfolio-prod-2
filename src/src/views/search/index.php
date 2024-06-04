      <section class="mt-10 py-6 sm:py-12 dark:bg-gray-100 dark:text-gray-800">
        <div class="container p-6 mx-auto space-y-8">
          <div class="space-y-2 text-center">
            <h2 class="text-3xl font-bold">検索結果</h2>
            <h2 class="text-3xl font-bold"><?php echo $word ?>は<?php echo $count ?>件です。</h2>
          </div>
          <div class="flex  justify-evenly flex-wrap">
            <?php foreach ($registers as $register) : ?>
              <div class="border border-cyan-500  max-w-xs p-6 rounded-md shadow-md dark:bg-gray-50 dark:text-gray-900 ">

                <img src="<?php echo $this->createPath($register['file_path']) ?>" alt="" class="object-cover object-center w-full rounded-md h-72 dark:bg-gray-500">
                <div class="mt-6 mb-2">
                  <span class="block  font-mono  text-xs font-medium tracking-widestdark:text-violet-600 mb-2">ロケーション</span>
                  <h2 class="text-xl font-semibold tracking-wide"><?php echo $register['location'] ?></h2>
                  <span class="block  font-mono  text-xs font-medium tracking-widestdark:text-violet-600 mb-2">名前</span>

                  <h2 class="text-xl font-semibold tracking-wide"><?php echo $register['name'] ?></h2>
                  <?php if ($register['other']) : ?>
                    <span class="block  font-mono  text-xs font-medium tracking-widestdark:text-violet-600 mb-2">memo</span>
                    <p class="dark:text-gray-800"><?php echo $register['other'] ?></p>
                  <?php endif; ?>
                </div>
                <a href="/update?id=<?= $register['register_id'] ?>" class="text-cyan-500 bg-black hover:bg-cyan-500 hover:text-yellow-400 inline-flex items-center rounded-md mt-3 py-2 px-3 text-sm font-medium cursor-pointer">
                  詳細
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <a href="/update?location_id=<?php echo $register['location_id'] ?>">
          <button class="align-middle select-none font-sans font-bold  text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-64 h-24 font-mono hover:text-base mx-auto mt-10" type="button">
            <span class="text-cyan-500">戻る</span>
          </button>
        </a>
      </section>
