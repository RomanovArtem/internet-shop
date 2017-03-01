<ul class="list">
    <li>Товары</li>
    <li><a class="select-brand" href="#"><? echo $selectBrand; ?></a>
        <div class="list-brands">
            <ul>
                <li><a href="product.php?category=all"><strong>Все товары</strong></a></li>
                <li><a href="product.php?category=snowboards"><strong>Сноуборды</strong></a></li>
                <?php
                $result = mysql_query("SELECT * FROM brands WHERE category='snowboard'", $link);
                if (mysql_num_rows($result) > 0)
                {
                    $row = mysql_fetch_array($result);
                    do
                    {
                        echo '<li><a href="product.php?category='.$row["category"].'&brand='.$row["brand"].'">'.$row["brand"].'</a></li>';
                    } while ($row = mysql_fetch_array($result));
                }
                ?>
            </ul>
            <ul>
                <li><a href="product.php?category=mounting"><strong>Крепления</strong></a></li>
                <?php
                $result = mysql_query("SELECT * FROM brands WHERE category='mounting'", $link);
                if (mysql_num_rows($result) > 0)
                {
                    $row = mysql_fetch_array($result);
                    do
                    {
                        echo '<li><a href="product.php?category='.$row["category"].'&brand='.$row["brand"].'">'.$row["brand"].'</a></li>';
                    } while ($row = mysql_fetch_array($result));
                }
                ?>
            </ul>
            <ul>
                <li><a href="product.php?category=boot"><strong>Ботинки</strong></a></li>
                <?php
                $result = mysql_query("SELECT * FROM brands WHERE category='boot'", $link);
                if (mysql_num_rows($result) > 0)
                {
                    $row = mysql_fetch_array($result);
                    do
                    {
                        echo '<li><a href="product.php?category='.$row["category"].'&brand='.$row["brand"].'">'.$row["brand"].'</a></li>';
                    } while ($row = mysql_fetch_array($result));
                }
                ?>
            </ul>
        </div>    
    </li>
</ul>