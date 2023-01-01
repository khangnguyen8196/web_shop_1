<style>
    #slider {
    margin-top:15px ;
    width: 900px;
    height: 300px;
    overflow: hidden;
}

#slider .slides {
    display: block;
    width: 6000px;
    height: 300px;
    margin: 0;
    padding: 0;
}

#slider .slide {
    float: left;
    list-style-type: none;
    width: 900px;
    height: 300px;
}

#slider .slide img {
    width: 900px;
    height: 300px;
}
</style>
        <div id="slider">
            <ul class="slides">
                <li class="slide"><img src="../images/1.jpg" /></li>
                <li class="slide"><img src="../images/2.jpg" /></li>
                <li class="slide"><img src="../images/3.jpg" /></li>
                <li class="slide"><img src="../images/4.jpg" /></li>
            </ul>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <script src="../js/slider.js"></script>
