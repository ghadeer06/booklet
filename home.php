<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: main.html");
    exit();
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Gallery</title>
  <link rel="stylesheet" href="homepage.css"> 
  
</head>
<body>

  <header>
    <div class="user-info">
      <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
      <br><br>
      <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
      </form>
	  
	  <form action="delete_user.php" method="POST" style="margin-top: 5px;">
  <button type="submit" style="background-color:#8B0000;">Delete User</button>
</form>
    </div>

    <h1>Welcome to the Bookstore</h1>
    <h4>Hope you would find what you need!</h4>
  </header>



<!-- مربع البحث -->
<div class="search-container">
  <input type="text" id="searchInput" placeholder="Search for a book...">
</div>

  <section class="book-grid">
    <?php
    // مصفوفة الكتب (كل كتاب يحتوي على اسم وصورة ورابط أمازون)
    $books = [
        ["A Good Girl’s Guide To Murder", "https://m.media-amazon.com/images/I/810KNXfKxNL.jpg", "https://www.amazon.com/dp/1405293187"],
        ["Shatter Me", "https://m.media-amazon.com/images/I/817dntOcfsL.jpg", "https://www.amazon.com/dp/0062085506"],
        ["Wimpy Kid", "https://m.media-amazon.com/images/I/81R2N4PRuUL._AC_UF894,1000_QL80_.jpg", "https://www.amazon.com/Diary-of-a-Wimpy-Kid/dp/B0051XV5Y6/ref=sr_1_4?dib=eyJ2IjoiMSJ9.SVbe-eY8-4u7Cwr7ogZKb7G9DWFwHgLJU1Wol5we0uaS_ugyQei6dHEfliahr-Qg6pyXbSmGwn8yL8TB9Q-u5g3HaFPHkfF--2sMD9VuZekNOAKuPa9B7vIhrJ6mJIDcLigzT4LUE-FMAYCp1N-uJJSoeOGtpks2_FfEMJx6WTuz04T1SuqR6_2GAPWQAL3mAjXsdV9wMhS62dGEvXiXFs-oW7pQTk1ss-ue4sSmmhH_C_d3f5TMQDlA6il0DLoMktaoDDzdnUMt0f8FHZe2Ae4U2J6arUtMNU955gDTPZg.Budh836GRe9T7T2BcoGvg5z1NZwyva3tM3CfTXLz0c0&dib_tag=se&keywords=wimpy+kid&qid=1762373761&sr=8-4"],
        ["Dog Man", "https://m.media-amazon.com/images/I/81NVwrwDgML.jpg", "https://www.amazon.com/Dog-Man-Creator-Captain-Underpants/dp/1338741039/ref=sr_1_3?crid=CF737VIWOXVE&dib=eyJ2IjoiMSJ9.yUWf_VDNFVZA0IlE01Lm73G6oMfyB4RH25xUbDW3Nq6sgR5KPDDU248nOJOCaKwCo2Xysxlwxsj8NAC3OCW2olZcJTx0uohzP1ejKXVZZGL7TF4YYoxN9UPJEnPn8HKQfKriHCUelGxqVxR7A8GSPPYWhpcUDA8cIDSgD-IMV9L2gSpuAfEtIG9fgXzxuAJaAvhC4QFOt8-a07ZtUw16HKPH5bpLw1OC6cVsFrHq1n8.v6gNBVGGGQUSp3tvT_w1bIYEo-ShtkUoiJ5wEDciEXM&dib_tag=se&keywords=dog+man&qid=1762373842&sprefix=dog+m%2Caps%2C490&sr=8-3"],
        ["Dork Diaries", "https://m.media-amazon.com/images/I/91PlXDY2v3L.jpg", "https://www.amazon.com/Dork-Diaries-Tales-Not-So-Fabulous-Life/dp/1416980067/ref=sr_1_4?dib=eyJ2IjoiMSJ9.uuA25DPVbFohw5OD2Z318Q09zcdNSbOH2ayKhKtRLOCnRVtCsVXuJ4bXHHk3_cldtWUhDrK8uagJIhPAwRXipwkEhQSf6RAnYx5d5n8kJ6_OUOI9eN3nK7NE2CJAuz7r3uUn1YoLbDstCn2NcOBkCcDuI9JGVVpnJCIVuHQLxDJJSPLDUHyfq9N1Jqebo7LVxg4xoL68DoG4YCnE5gVF5DT95ITm645Xf4pBjR2osc4_1ScItBEBODl65vbz3d1OgFJVghYrSsgrSZrFhKyPryR1-Xm0uQG3CSOQhioHJ-M.ILevsq5-9ScBXnzUWAEAONT_iOaMMmmK915tg2jfGNE&dib_tag=se&keywords=Dork+Diaries&qid=1762373893&sr=8-4"],
        ["Harry Potter", "https://m.media-amazon.com/images/I/81q77Q39nEL._AC_UF894,1000_QL80_.jpg", "https://www.amazon.com/dp/059035342X"],
		["fancy nancy","https://m.media-amazon.com/images/I/719Xl1J-dyL._UF894,1000_QL80_.jpg","https://www.amazon.com/dp/0060089812"],
		["Detective Conan 1", "https://m.media-amazon.com/images/I/81a9xLAmIxL._AC_UF1000,1000_QL80_.jpg", "https://www.amazon.com/dp/B00K2O1J4Y"],
		["naruto","https://m.media-amazon.com/images/I/91RpwagB7uL.jpg","https://www.amazon.com/dp/1569319006"],
		["The Very Hungry Caterpillar","https://shopatdawn.com/cdn/shop/files/tvhcbook-2.webp?crop=center&height=1200&v=1683312686&width=1200","https://www.amazon.com/dp/0399226907"]
    ];

    foreach ($books as $book) {
        $bookName = $book[0];
        $img = $book[1];
        $link = $book[2];
        echo "
        <div class='book-card'>
          <img src='$img' alt='$bookName'>
          <h3><a href='$link' target='_blank'>$bookName</a></h3>
          <div class='comments'>
            <form method='POST' action='save_comment.php'>
              <input type='hidden' name='book' value='$bookName'>
              <textarea class='comment-box' name='comment' placeholder='Write your opinion'></textarea>
              <button type='submit' class='comment-btn'>Post</button>
            </form>";

        // عرض التعليقات الخاصة بهذا الكتاب
        $commentsFile = "comments.json";
        if (file_exists($commentsFile)) {
            $data = json_decode(file_get_contents($commentsFile), true);
            if (isset($data[$bookName])) {
                echo "<div class='comment-list'>";
                foreach ($data[$bookName] as $c) {
                    echo "<p><b>{$c['user']}:</b> {$c['text']}</p>";
                }
                echo "</div>";
            }
        }
        echo "</div></div>";
    }
    ?>
  </section>

  <footer>
    <p>© 2025 My Bookstore | All rights reserved.</p>
  </footer>
  <script>
document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.getElementById('searchInput');
  const books = document.querySelectorAll('.book-card');

  searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase().trim();

    books.forEach(book => {
      const title = book.querySelector('h3').innerText.toLowerCase();
      if (title.includes(filter)) {
        book.style.display = '';
      } else {
        book.style.display = 'none';
      }
    });
  });
});
</script>
</body>
</html>