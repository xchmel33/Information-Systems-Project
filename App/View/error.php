<div id="home">
    <h1>Sorry, the page you were looking for does not exist on our server :(</h1>
    <h3>Try again:</h3>
    <form id="search_form" method="post">
        <input id="search" type="search">
        <input type="button" onclick="searchSite()" value="Search Web Bids">
    </form>
    <script type="text/javascript">
        function searchSite(){
            document.getElementById('search_form').action = document.getElementById('search').value;
            document.getElementById('search_form').submit();
        }
    </script>
</div>
