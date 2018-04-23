
<!DOCTYPE html>
<html lang="en">
<?php
include("login.php");
include("includes/head.php");
?>
<body>
<div id="navb">
    <?php
    include("includes/topbar.php");
    include("includes/navbar.php");
    ?>
</div>
<div id="all">
    <div id="content">
        <div id="hot">

            <div class="box">
                <div class="container">
                    <div class="col-md-11">
                        <h2>FAQ<h2>
                                    <SCRIPT LANGUAGE="JavaScript">
                                        <!--
                                        function showFAQ(form) {
                                            form.answer.value = form.question.options[form.question.selectedIndex].value;
                                        }
                                        // -->

                                    </SCRIPT>
                                    <center>
                                    <form name="faqform">
                                                        <center>Browse the "Frequently Asked Questions" below and click the question of your choice for the answer.
                                                            <p>
                                                            <ul><select size="3" name="question" onChange="javascript:showFAQ(this.form);"></center>
                                                                    <option value="People selling stuff.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who are you?
                                                                    <option value="the safest!">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;is this website safe?
                                                                    <option value="NO, this is the most secure website on earth."/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;is this site hackable?

                                                            </select>
                                                            </ul>
                                                            <p>
                                                                <center>The answers appear below.<center>
                                                            <p>
                                                            <ul>
                                                                <textarea name="answer" rows="5" cols="50" wrap="virtual"></textarea>
                                                            </ul>
                                                    </font>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </center>
                    </div>
</body>
</html>

</div>
                </div>
            </div>

        </div>
        <?php
        include("includes/footer.php");
        include("includes/copyright.php");
        ?>
    </div>
    <?php include("includes/scripts.php"); ?>
</body>
</html>
