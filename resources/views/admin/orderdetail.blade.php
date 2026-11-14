<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Admin Order Detail</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700&family=Abril+Fatface&family=Amethysta&family=Inter:wght@400;600;700&family=Lato:wght@400;500;700&family=Nunito+Sans:wght@400;600;800&family=Playfair+Display:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Volkhov:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-search" viewBox="0 0 30 30"><path d="M26.25 26.25L20.8125 20.8125M23.75 13.75C23.75 19.2728 19.2728 23.75 13.75 23.75C8.22715 23.75 3.75 19.2728 3.75 13.75C3.75 8.22715 8.22715 3.75 13.75 3.75C19.2728 3.75 23.75 8.22715 23.75 13.75Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-chev" viewBox="0 0 20 20"><path d="M16.25 6.875L10 13.125L3.75 6.875" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>

  <symbol id="i-ig" viewBox="0 0 48 48"><path fill="currentColor" d="M23.9999 15.6666C26.264 15.6666 26.5465 15.6749 27.4349 15.7166C28.3224 15.7583 28.9265 15.8974 29.4582 16.1041C30.0082 16.3158 30.4715 16.6024 30.9349 17.0649C31.3586 17.4815 31.6865 17.9854 31.8957 18.5416C32.1015 19.0724 32.2415 19.6774 32.2832 20.5649C32.3224 21.4533 32.3332 21.7358 32.3332 23.9999C32.3332 26.2641 32.3249 26.5466 32.2832 27.4349C32.2415 28.3224 32.1015 28.9266 31.8957 29.4583C31.6871 30.0147 31.3591 30.5188 30.9349 30.9349C30.5182 31.3585 30.0143 31.6864 29.4582 31.8958C28.9274 32.1016 28.3224 32.2416 27.4349 32.2833C26.5465 32.3224 26.264 32.3333 23.9999 32.3333C21.7357 32.3333 21.4532 32.3249 20.5649 32.2833C19.6774 32.2416 19.0732 32.1016 18.5415 31.8958C17.9851 31.687 17.4811 31.359 17.0649 30.9349C16.641 30.5184 16.3131 30.0145 16.104 29.4583C15.8974 28.9274 15.7582 28.3224 15.7165 27.4349C15.6774 26.5466 15.6665 26.2641 15.6665 23.9999C15.6665 21.7358 15.6749 21.4533 15.7165 20.5649C15.7582 19.6766 15.8974 19.0733 16.104 18.5416C16.3126 17.9851 16.6405 17.481 17.0649 17.0649C17.4813 16.6409 17.9852 16.313 18.5415 16.1041C19.0732 15.8974 19.6765 15.7583 20.5649 15.7166C21.4532 15.6774 21.7357 15.6666 23.9999 15.6666ZM23.9999 19.8333C22.8948 19.8333 21.835 20.2722 21.0536 21.0536C20.2722 21.835 19.8332 22.8949 19.8332 23.9999C19.8332 25.105 20.2722 26.1648 21.0536 26.9462C21.835 27.7276 22.8948 28.1666 23.9999 28.1666C25.1049 28.1666 26.1647 27.7276 26.9461 26.9462C27.7276 26.1648 28.1665 25.105 28.1665 23.9999C28.1665 22.8949 27.7276 21.835 26.9461 21.0536C26.1647 20.2722 25.1049 19.8333 23.9999 19.8333ZM29.4165 19.6249C29.4165 19.3487 29.3068 19.0837 29.1114 18.8884C28.9161 18.693 28.6511 18.5833 28.3749 18.5833C28.0986 18.5833 27.8337 18.693 27.6383 18.8884C27.443 19.0837 27.3332 19.3487 27.3332 19.6249C27.3332 19.9012 27.443 20.1661 27.6383 20.3615C27.8337 20.5568 28.0986 20.6666 28.3749 20.6666C28.6511 20.6666 28.9161 20.5568 29.1114 20.3615C29.3068 20.1661 29.4165 19.9012 29.4165 19.6249ZM23.9999 21.4999C24.6629 21.4999 25.2988 21.7633 25.7676 22.2322C26.2365 22.701 26.4999 23.3369 26.4999 23.9999C26.4999 24.663 26.2365 25.2988 25.7676 25.7677C25.2988 26.2365 24.6629 26.4999 23.9999 26.4999C23.3368 26.4999 22.7009 26.2365 22.2321 25.7677C21.7633 25.2988 21.4999 24.663 21.4999 23.9999C21.4999 23.3369 21.7633 22.701 22.2321 22.2322C22.7009 21.7633 23.3368 21.4999 23.9999 21.4999Z"/></symbol>
  <symbol id="i-call" viewBox="0 0 48 48"><path d="M26.5417 18.1667C27.3556 18.3255 28.1037 18.7235 28.6901 19.3099C29.2765 19.8963 29.6745 20.6444 29.8333 21.4583M26.5417 14.8333C28.2327 15.0212 29.8097 15.7785 31.0135 16.9808C32.2174 18.1832 32.9767 19.7592 33.1667 21.45M32.3333 28.1V30.6C32.3343 30.8321 32.2867 31.0618 32.1938 31.2745C32.1008 31.4871 31.9644 31.678 31.7934 31.8349C31.6224 31.9918 31.4205 32.1112 31.2006 32.1856C30.9808 32.2599 30.7478 32.2876 30.5167 32.2667C27.9524 31.988 25.4892 31.1118 23.325 29.7083C21.3115 28.4289 19.6044 26.7218 18.325 24.7083C16.9166 22.5343 16.0402 20.0592 15.7667 17.4833C15.7458 17.2529 15.7732 17.0206 15.8471 16.8014C15.9209 16.5821 16.0396 16.3806 16.1956 16.2097C16.3516 16.0388 16.5415 15.9023 16.7532 15.8088C16.9648 15.7153 17.1936 15.6669 17.425 15.6667H19.925C20.3294 15.6627 20.7215 15.8059 21.0281 16.0696C21.3348 16.3333 21.5351 16.6995 21.5917 17.1C21.6972 17.9001 21.8929 18.6856 22.175 19.4417C22.2871 19.7399 22.3114 20.0641 22.2449 20.3757C22.1785 20.6874 22.0241 20.9734 21.8 21.2L20.7417 22.2583C21.928 24.3446 23.6554 26.072 25.7417 27.2583L26.8 26.2C27.0266 25.9759 27.3126 25.8215 27.6243 25.7551C27.9359 25.6886 28.2601 25.7129 28.5583 25.825C29.3144 26.1071 30.0999 26.3028 30.9 26.4083C31.3048 26.4654 31.6745 26.6693 31.9388 26.9812C32.2031 27.2932 32.3435 27.6913 32.3333 28.1Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-mail" viewBox="0 0 48 48"><path fill="currentColor" d="M16 32C15.45 32 14.9792 31.8042 14.5875 31.4125C14.1958 31.0208 14 30.55 14 30V18C14 17.45 14.1958 16.9792 14.5875 16.5875C14.9792 16.1958 15.45 16 16 16H32C32.55 16 33.0208 16.1958 33.4125 16.5875C33.8042 16.9792 34 17.45 34 18V30C34 30.55 33.8042 31.0208 33.4125 31.4125C33.0208 31.8042 32.55 32 32 32H16ZM24 25L16 20V30H32V20L24 25ZM24 23L32 18H16L24 23Z"/></symbol>
  <symbol id="i-bag" viewBox="0 0 48 48"><path d="M33 18V32C33 32.5304 32.7893 33.0391 32.4142 33.4142C32.0391 33.7893 31.5304 34 31 34H17C16.4696 34 15.9609 33.7893 15.5858 33.4142C15.2107 33.0391 15 32.5304 15 32V18L18 14H30L33 18ZM15 18H33M28 22C28 23.0609 27.5786 24.0783 26.8284 24.8284C26.0783 25.5786 25.0609 26 24 26C22.9391 26 21.9217 25.5786 21.1716 24.8284C20.4214 24.0783 20 23.0609 20 22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-globe" viewBox="0 0 48 48"><path fill="currentColor" d="M24 34C22.6333 34 21.3417 33.7375 20.125 33.2125C18.9083 32.6875 17.8458 31.9708 16.9375 31.0625C16.0292 30.1542 15.3125 29.0917 14.7875 27.875C14.2625 26.6583 14 25.3667 14 24C14 22.6167 14.2625 21.3208 14.7875 20.1125C15.3125 18.9042 16.0292 17.8458 16.9375 16.9375C17.8458 16.0292 18.9083 15.3125 20.125 14.7875C21.3417 14.2625 22.6333 14 24 14C25.3833 14 26.6792 14.2625 27.8875 14.7875C29.0958 15.3125 30.1542 16.0292 31.0625 16.9375C31.9708 17.8458 32.6875 18.9042 33.2125 20.1125C33.7375 21.3208 34 22.6167 34 24C34 25.3667 33.7375 26.6583 33.2125 27.875C32.6875 29.0917 31.9708 30.1542 31.0625 31.0625C30.1542 31.9708 29.0958 32.6875 27.8875 33.2125C26.6792 33.7375 25.3833 34 24 34ZM24 31.95C24.4333 31.35 24.8083 30.725 25.125 30.075C25.4417 29.425 25.7 28.7333 25.9 28H22.1C22.3 28.7333 22.5583 29.425 22.875 30.075C23.1917 30.725 23.5667 31.35 24 31.95ZM21.4 31.55C21.1 31 20.8375 30.4292 20.6125 29.8375C20.3875 29.2458 20.2 28.6333 20.05 28H17.1C17.5833 28.8333 18.1875 29.5583 18.9125 30.175C19.6375 30.7917 20.4667 31.25 21.4 31.55ZM26.6 31.55C27.5333 31.25 28.3625 30.7917 29.0875 30.175C29.8125 29.5583 30.4167 28.8333 30.9 28H27.95C27.8 28.6333 27.6125 29.2458 27.3875 29.8375C27.1625 30.4292 26.9 31 26.6 31.55ZM16.25 26H19.65C19.6 25.6667 19.5625 25.3375 19.5375 25.0125C19.5125 24.6875 19.5 24.35 19.5 24C19.5 23.65 19.5125 23.3125 19.5375 22.9875C19.5625 22.6625 19.6 22.3333 19.65 22H16.25C16.1667 22.3333 16.1042 22.6625 16.0625 22.9875C16.0208 23.3125 16 23.65 16 24C16 24.35 16.0208 24.6875 16.0625 25.0125C16.1042 25.3375 16.1667 25.6667 16.25 26ZM21.65 26H26.35C26.4 25.6667 26.4375 25.3375 26.4625 25.0125C26.4875 24.6875 26.5 24.35 26.5 24C26.5 23.65 26.4875 23.3125 26.4625 22.9875C26.4375 22.6625 26.4 22.3333 26.35 22H21.65C21.6 22.3333 21.5625 22.6625 21.5375 22.9875C21.5125 23.3125 21.5 23.65 21.5 24C21.5 24.35 21.5125 24.6875 21.5375 25.0125C21.5625 25.3375 21.6 25.6667 21.65 26ZM28.35 26H31.75C31.8333 25.6667 31.8958 25.3375 31.9375 25.0125C31.9792 24.6875 32 24.35 32 24C32 23.65 31.9792 23.3125 31.9375 22.9875C31.8958 22.6625 31.8333 22.3333 31.75 22H28.35C28.4 22.3333 28.4375 22.6625 28.4625 22.9875C28.4875 23.3125 28.5 23.65 28.5 24C28.5 24.35 28.4875 24.6875 28.4625 25.0125C28.4375 25.3375 28.4 25.6667 28.35 26ZM27.95 20H30.9C30.4167 19.1667 29.8125 18.4417 29.0875 17.825C28.3625 17.2083 27.5333 16.75 26.6 16.45C26.9 17 27.1625 17.5708 27.3875 18.1625C27.6125 18.7542 27.8 19.3667 27.95 20ZM22.1 20H25.9C25.7 19.2667 25.4417 18.575 25.125 17.925C24.8083 17.275 24.4333 16.65 24 16.05C23.5667 16.65 23.1917 17.275 22.875 17.925C22.5583 18.575 22.3 19.2667 22.1 20ZM17.1 20H20.05C20.2 19.3667 20.3875 18.7542 20.6125 18.1625C20.8375 17.5708 21.1 17 21.4 16.45C20.4667 16.75 19.6375 17.2083 18.9125 17.825C18.1875 18.4417 17.5833 19.1667 17.1 20Z"/></symbol>

<symbol id="i-ad-grid" viewBox="0 0 25 25"><g fill="none" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"><path d="M4.16667 3.125H9.375C9.9503 3.125 10.4167 3.59137 10.4167 4.16667V11.4583C10.4167 12.0336 9.9503 12.5 9.375 12.5H4.16667C3.59137 12.5 3.125 12.0336 3.125 11.4583V4.16667C3.125 3.59137 3.59137 3.125 4.16667 3.125Z"/><path d="M15.6237 3.125H20.832C21.4073 3.125 21.8737 3.59137 21.8737 4.16667V7.29167C21.8737 7.86696 21.4073 8.33333 20.832 8.33333H15.6237C15.0484 8.33333 14.582 7.86696 14.582 7.29167V4.16667C14.582 3.59137 15.0484 3.125 15.6237 3.125Z"/><path d="M15.6237 12.5H20.832C21.4073 12.5 21.8737 12.9664 21.8737 13.5417V20.8333C21.8737 21.4086 21.4073 21.875 20.832 21.875H15.6237C15.0484 21.875 14.582 21.4086 14.582 20.8333V13.5417C14.582 12.9664 15.0484 12.5 15.6237 12.5Z"/><path d="M4.16667 16.6666H9.375C9.9503 16.6666 10.4167 17.133 10.4167 17.7083V20.8333C10.4167 21.4086 9.9503 21.875 9.375 21.875H4.16667C3.59137 21.875 3.125 21.4086 3.125 20.8333V17.7083C3.125 17.133 3.59137 16.6666 4.16667 16.6666Z"/></g></symbol>

<symbol id="i-ad-card" viewBox="0 0 26 26"><g fill="currentColor" stroke="none"><path d="M22.9608 7.16342V6.80775C22.9608 5.17274 21.6306 3.84253 19.9956 3.84253H2.96522C1.33016 3.84258 0 5.17274 0 6.80775V7.16342H22.9608Z"/><path d="M13.5651 16.7017C13.5651 15.1636 14.0598 13.7017 14.9731 12.4968H0V16.6331C0 18.2681 1.33016 19.5983 2.96522 19.5983H14.1911C13.7813 18.7007 13.5651 17.7179 13.5651 16.7017ZM11.4804 15.803H8.92125V14.2796H11.4804V15.803ZM3.41545 14.2796H7.39781V15.803H3.41545V14.2796Z"/><path d="M16.5547 10.9734C17.7165 10.1606 19.0967 9.72262 20.5443 9.72262C21.3822 9.72262 22.1973 9.86974 22.9608 10.1509V8.68689H0V10.9734H16.5547Z"/><path d="M26.0013 16.7018C26.0013 13.6887 23.5587 11.2461 20.5456 11.2461C17.5325 11.2461 15.0898 13.6887 15.0898 16.7018C15.0898 19.7149 17.5324 22.1575 20.5456 22.1575C23.5587 22.1575 26.0013 19.7149 26.0013 16.7018ZM21.281 19.6164V20.2364H20.5193H19.7576V19.6209C19.297 19.465 18.9202 19.1906 18.5523 18.9215L19.4516 17.6919C19.946 18.0534 20.1989 18.2272 20.5456 18.2272C20.7416 18.2272 20.9003 18.1339 20.9598 17.9838C21.0318 17.802 20.93 17.6345 20.6874 17.5357C20.6874 17.5357 19.5986 17.1726 19.0952 16.6593C18.6729 16.2288 18.5385 15.622 18.673 15.0447C18.8083 14.4635 19.2008 14.0091 19.7576 13.7822V13.1671H21.281V13.7567C21.6679 13.8641 21.9954 14.0229 22.1837 14.1251L21.4568 15.464C20.9749 15.2024 20.5316 15.1239 20.3591 15.1829C20.1916 15.2401 20.1662 15.3493 20.1566 15.3904C20.143 15.4486 20.1358 15.538 20.2289 15.6418C20.3185 15.7417 21.2618 16.1248 21.2618 16.1248C22.2796 16.5391 22.7585 17.5795 22.376 18.5449C22.1773 19.0467 21.7774 19.4267 21.281 19.6164Z"/></g></symbol>

<symbol id="i-ad-truck" viewBox="0 0 30 30"><g fill="currentColor" stroke="none"><path d="M4.21875 5.625C2.92433 5.625 1.875 6.67433 1.875 7.96875V16.875H16.875V7.96875C16.875 6.67433 15.8257 5.625 14.5312 5.625H4.21875Z"/><path d="M16.875 18.75H1.875V22.0312C1.875 23.3257 2.92433 24.375 4.21875 24.375H4.6875C4.6875 22.3039 6.36643 20.625 8.4375 20.625C10.5086 20.625 12.1875 22.3039 12.1875 24.375H15.9375C16.4553 24.375 16.875 23.9553 16.875 23.4375V18.75Z"/><path d="M10.3125 24.375C10.3125 23.3395 9.47303 22.5 8.4375 22.5C7.40197 22.5 6.5625 23.3395 6.5625 24.375C6.5625 25.4105 7.40197 26.25 8.4375 26.25C9.47303 26.25 10.3125 25.4105 10.3125 24.375Z"/><path d="M19.6875 8.4375C19.1697 8.4375 18.75 8.85723 18.75 9.375V23.4375C18.75 23.546 18.7684 23.6502 18.8023 23.7471C19.1011 21.975 20.6429 20.625 22.5 20.625C24.5552 20.625 26.2243 22.2783 26.2497 24.3275C27.3164 24.1087 28.153 23.1583 28.08 21.9743C27.7888 17.2488 26.0969 12.9013 23.4155 9.34362C22.9725 8.75578 22.2832 8.4375 21.5776 8.4375H19.6875Z"/><path d="M24.375 24.375C24.375 23.3395 23.5355 22.5 22.5 22.5C21.4645 22.5 20.625 23.3395 20.625 24.375C20.625 25.4105 21.4645 26.25 22.5 26.25C23.5355 26.25 24.375 25.4105 24.375 24.375Z"/></g></symbol>

<symbol id="i-ad-store" viewBox="0 0 25 25"><g fill="currentColor" stroke="none"><path d="M3.92074 10.2272H1.1367C0.509043 10.2272 0 10.7362 0 11.3639V23.8639C0 24.491 0.509043 25 1.1367 25H3.92074C4.5484 25 5.05692 24.491 5.05692 23.8639V11.3639C5.05692 10.7362 4.5484 10.2272 3.92074 10.2272Z"/><path d="M10.5692 13.6356H7.78514C7.15695 13.6356 6.64844 14.1447 6.64844 14.7723V23.8627C6.64844 24.4909 7.15695 24.9994 7.78514 24.9994H10.5692C11.1968 24.9994 11.7054 24.4904 11.7054 23.8627V14.7723C11.7054 14.1447 11.1968 13.6356 10.5692 13.6356Z"/><path d="M17.2171 13.6356H14.433C13.8054 13.6356 13.2969 14.1447 13.2969 14.7723V23.8627C13.2969 24.4909 13.8054 24.9994 14.433 24.9994H17.2171C17.8453 24.9994 18.3538 24.4904 18.3538 23.8627V14.7723C18.3538 14.1447 17.8453 13.6356 17.2171 13.6356Z"/><path d="M23.8616 10.2272H21.0776C20.4499 10.2272 19.9414 10.7362 19.9414 11.3639V23.8639C19.9414 24.4915 20.4499 25 21.0776 25H23.8616C24.4893 25 24.9983 24.4905 24.9983 23.8639V11.3639C24.9983 10.7362 24.4893 10.2272 23.8616 10.2272Z"/><path d="M12.832 6.8457V8.89145C13.4512 8.85049 14.1038 8.56007 14.1038 7.87868C14.1038 7.17549 13.3884 6.96964 12.832 6.8457Z"/><path d="M11.0508 4.39732C11.0508 4.91434 11.4354 5.21328 12.2104 5.3686V3.51807C11.5061 3.53881 11.0508 3.95264 11.0508 4.39732Z"/><path d="M12.5 0C9.05372 0 6.25 2.80426 6.25 6.25C6.25 9.69468 9.05372 12.4989 12.5 12.4989C15.9463 12.4989 18.75 9.69468 18.75 6.25C18.75 2.80426 15.9463 0 12.5 0ZM12.8314 9.94628V10.5862C12.8314 10.7622 12.6963 10.9378 12.5197 10.9378C12.3452 10.9378 12.2117 10.7622 12.2117 10.5862V9.94628C10.4654 9.90372 9.59681 8.86011 9.59681 8.04362C9.59681 7.63138 9.84628 7.39309 10.2367 7.39309C11.3941 7.39309 10.4941 8.81915 12.2117 8.89096V6.73138C10.6798 6.45319 9.75213 5.78138 9.75213 4.63457C9.75213 3.22979 10.9202 2.50532 12.2117 2.46489V1.91383C12.2117 1.73777 12.3452 1.56223 12.5197 1.56223C12.6963 1.56223 12.8314 1.73777 12.8314 1.91383V2.46489C13.6367 2.48617 15.2904 2.99149 15.2904 4.00479C15.2904 4.40745 14.9894 4.64468 14.6378 4.64468C13.9654 4.64468 13.975 3.53989 12.8314 3.51862V5.48191C14.1952 5.77181 15.4032 6.17447 15.4032 7.76596C15.4032 9.15 14.3702 9.85213 12.8314 9.94628Z"/></g></symbol>

<symbol id="i-ad-user" viewBox="0 0 25 25"><g fill="currentColor" stroke="none"><path d="M12.3223 12.0426C13.9767 12.0426 15.4093 11.4492 16.5799 10.2785C17.7504 9.10793 18.3438 7.67571 18.3438 6.02109C18.3438 4.36705 17.7504 2.93463 16.5797 1.76372C15.4089 0.593374 13.9765 0 12.3223 0C10.6677 0 9.23543 0.593374 8.06489 1.76391C6.89435 2.93444 6.30078 4.36686 6.30078 6.02109C6.30078 7.67571 6.89435 9.10813 8.06508 10.2787C9.23581 11.449 10.6682 12.0426 12.3223 12.0426Z"/><path d="M22.8579 19.2237C22.8241 18.7366 22.7558 18.2052 22.6553 17.644C22.5538 17.0787 22.4232 16.5443 22.2668 16.0558C22.1052 15.5509 21.8855 15.0523 21.6139 14.5745C21.332 14.0786 21.0009 13.6468 20.6293 13.2915C20.2408 12.9197 19.7651 12.6209 19.215 12.4028C18.6668 12.186 18.0593 12.0761 17.4095 12.0761C17.1543 12.0761 16.9075 12.1808 16.4309 12.4912C16.1375 12.6825 15.7944 12.9037 15.4114 13.1484C15.0839 13.3571 14.6402 13.5526 14.0923 13.7296C13.5576 13.9026 13.0148 13.9903 12.479 13.9903C11.9432 13.9903 11.4006 13.9026 10.8654 13.7296C10.318 13.5528 9.87434 13.3573 9.54723 13.1486C9.16786 12.9062 8.82454 12.6849 8.5268 12.491C8.05073 12.1806 7.80373 12.0759 7.54852 12.0759C6.8985 12.0759 6.2912 12.186 5.74322 12.403C5.19352 12.6207 4.71764 12.9195 4.32873 13.2917C3.95737 13.6472 3.62606 14.0788 3.34454 14.5745C3.07312 15.0523 2.85339 15.5507 2.69165 16.056C2.53544 16.5444 2.40479 17.0787 2.30331 17.644C2.2028 18.2044 2.13451 18.736 2.10075 19.2243C2.06757 19.7026 2.05078 20.1991 2.05078 20.7005C2.05078 22.0055 2.46563 23.062 3.28369 23.8412C4.09164 24.61 5.16071 25.0001 6.46076 25.0001H18.4984C19.7985 25.0001 20.8672 24.6102 21.6753 23.8412C22.4936 23.0626 22.9084 22.0059 22.9084 20.7003C22.9082 20.1966 22.8912 19.6998 22.8579 19.2237Z"/></g></symbol>  <symbol id="i-logout" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4M16 8l4 4-4 4M20 12H9"/></g></symbol>
</svg>

<main>

  <!-- ================= HEADER ADMIN ================= -->
  <header class="site-header ad-header">
    <a class="brand" href="{{ route('homepage2') }}" aria-label="Zarabel home">
      <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
      <span>arabel</span>
    </a>

    <button class="menu-toggle" id="menuToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span>
    </button>

    <nav id="mainNav" aria-label="Main navigation">
      <button onclick="location.href='{{ route('homepage2') }}'">Home</button>
      <button class="active" onclick="location.href='{{ route('admin.dashboard') }}'">Admin</button>
    </nav>

    <div class="header-actions">
      <button aria-label="Search"><svg class="ic"><use href="#i-search"/></svg></button>
    </div>
  </header>

  <!-- ================= BANNER ADMIN ================= -->
  <section class="ad-banner">
    <h2>Admin</h2>
    <nav class="ad-tabs" aria-label="Admin menu">
      <a class="ad-tab {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><svg class="ic"><use href="#i-ad-grid"/></svg>Dashboard</a>
      <a class="ad-tab {{ request()->routeIs('admin.sales*') ? 'active' : '' }}" href="{{ route('admin.sales') }}"><svg class="ic"><use href="#i-ad-card"/></svg>Sales Reports</a>
      <a class="ad-tab {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" href="{{ route('admin.orders') }}"><svg class="ic"><use href="#i-ad-truck"/></svg>Orders</a>
      <a class="ad-tab {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}"><svg class="ic"><use href="#i-ad-store"/></svg>Products</a>
      <a class="ad-tab {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}"><svg class="ic"><use href="#i-ad-user"/></svg>Users</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a class="ad-logout" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out <svg class="ic"><use href="#i-logout"/></svg></a>
  </section>

  <!-- ================= ISI ORDER ================= -->
  <section class="ao-content">
    <h1 class="ao-title">Orders</h1>

    <div class="ao-card">
      <div class="ao-avatar"><img src="{{ asset('assets/img/org.png') }}" alt=""></div>
      <h2 class="ao-name" id="aoName"></h2>

      <div class="ao-cols">
        <div class="ao-col">
          <label class="ao-field"><span>ID Order</span><input type="text" id="aoId" readonly></label>
          <label class="ao-field"><span>Tanggal Pembayaran</span><input type="text" id="aoDate" readonly></label>
          <label class="ao-field"><span>Metode Pembayaran</span><input type="text" id="aoMethod" readonly></label>
          <label class="ao-field"><span>Status</span>
            <span class="ao-select">
              <select id="aoStatus" aria-label="Order status">
                <option>Awaiting payment</option>
                <option>Payment received</option>
                <option>Dispatched</option>
                <option>Completed</option>
                <option>Cancelled</option>
              </select>
              <svg class="ic"><use href="#i-chev"/></svg>
            </span>
          </label>
        </div>
        <div class="ao-col">
          <label class="ao-field"><span>Customer</span><input type="text" id="aoCustomer" readonly></label>
          <label class="ao-field"><span>Price</span><input type="text" id="aoPrice" readonly></label>
          <label class="ao-field"><span>Address</span><textarea id="aoAddress" readonly></textarea></label>
        </div>
      </div>

      <h3 class="ao-receipt-title">Receipt</h3>
      <div class="ao-receipt">
        <div id="aoItems"></div>
        <dl class="ao-sum">
          <div><dt>Subtotal</dt><dd id="aoSub"></dd></div>
          <div><dt>Voucher (<span id="aoCode"></span>)</dt><dd id="aoVoucher"></dd></div>
          <div><dt>Shipping</dt><dd>IDR -</dd></div>
          <div class="total"><dt>Total</dt><dd id="aoTotal"></dd></div>
        </dl>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer id="about">
    <div class="footer-brand">
      <div class="brand footer-logo">
        <img src="{{ asset('assets/img/zarabelbg.png') }}" alt="">
        <span>arabel</span>
      </div>
      <p>Artistic Printed Wonderful Indonesian Textile Design</p>
      <div class="socials">
        <button aria-label="Instagram"><svg class="ic"><use href="#i-ig"/></svg></button>
        <button aria-label="Phone"><svg class="ic"><use href="#i-call"/></svg></button>
        <button aria-label="Email"><svg class="ic"><use href="#i-mail"/></svg></button>
        <button aria-label="Shop"><svg class="ic"><use href="#i-bag"/></svg></button>
        <button aria-label="Website"><svg class="ic"><use href="#i-globe"/></svg></button>
      </div>
    </div>

    <div class="footer-links">
      <div><strong>Information</strong><button>About Us</button><button>Contact</button><button>Blog</button></div>
      <div><strong>Company</strong><button>Community</button><button>Career</button><button>Our story</button></div>
      <div><strong>Contact</strong><button>Getting Started</button><button>Pricing</button><button>Resources</button></div>
    </div>

    <p class="copyright">Copyright © 2026 Xpro. All Rights Reserved · Terms of use ZARABEL</p>
  </footer>

</main>

<div class="ao-toast" id="aoToast" role="status"></div>

<script>
  // Menu HP
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
  });

  // Data order (id dikirim lewat ?id=I0001, sama dengan halaman My Orders user)
  var ORDERS = {
    I0001:{ status:'Payment received', method:'Transfer Bank BCA', date:'12 Mei 2026',
            items:[ { name:'Sony Alpha A7 IV', qty:1, unit:450000 }, { name:'Lensa Sony 50mm f/1.8', qty:1, unit:150000 } ] },
    I0002:{ status:'Awaiting payment', method:'Virtual Account', date:'-',
            items:[ { name:'ALLTREK Tenda Camping 1', qty:2, unit:450000 }, { name:'Matras Camping', qty:2, unit:50000 } ] },
    I0003:{ status:'Dispatched', method:'QRIS', date:'14 Mei 2026',
            items:[ { name:'Mobil Fortuner Hitam', qty:1, unit:1000000 }, { name:'Sopir Harian', qty:1, unit:300000 } ] },
    I0004:{ status:'Completed', method:'Transfer Bank BNI', date:'02 Mei 2026',
            items:[ { name:'Yamaha Pro Audio Paket', qty:2, unit:750000 }, { name:'Microphone Wireless', qty:2, unit:100000 } ] },
    I0005:{ status:'Awaiting payment', method:'Virtual Account', date:'-',
            items:[ { name:'Iphone 17 Air (Hijau)', qty:1, unit:300000 }, { name:'Casing Iphone 17 Air', qty:1, unit:25000 } ] },
    I0006:{ status:'Completed', method:'GoPay', date:'28 Apr 2026',
            items:[ { name:'Kebaya Cream (1 Set)', qty:1, unit:630000 }, { name:'Selendang Batik', qty:1, unit:75000 } ] }
  };
  var STATUS_UI = {
    'Payment received':{ label:'PAID',       cls:'' },
    'Completed':       { label:'PAID',       cls:'' },
    'Dispatched':      { label:'SHIPPING',   cls:'is-ship' },
    'Awaiting payment':{ label:'UNPAID',     cls:'is-wait' },
    'Cancelled':       { label:'CANCELLED',  cls:'is-cancel' }
  };
  var VOUCHER = { code:'SDKDISCOUNT', amount:50000 };

  function idr(n){ return 'IDR ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
  function esc(t){ var d = document.createElement('div'); d.textContent = t; return d.innerHTML; }
  function $(id){ return document.getElementById(id); }

  var routeId = "{{ $id ?? '' }}";
  var id = routeId || new URLSearchParams(location.search).get('id');
  if (!ORDERS[id]) id = 'I0001';
  var o = ORDERS[id];

  // status yang pernah diubah admin
  var saved = {};
  try { saved = JSON.parse(localStorage.getItem('orderStatuses') || '{}'); } catch(e) {}
  var status = saved[id] || o.status;

  var sub = 0;
  o.items.forEach(function(it){ sub += it.unit * it.qty; });

  function render(){
    var ui = STATUS_UI[status] || STATUS_UI['Payment received'];
    var disc = status === 'Awaiting payment' ? 0 : VOUCHER.amount;

    $('aoItems').innerHTML = o.items.map(function(it, i){
      return '<div class="ao-item">' +
        '<div class="ao-thumb"><img src="{{ asset('assets/img/cart.png') }}" alt=""><span class="ao-badge">' + it.qty + '</span></div>' +
        '<div class="ao-info"><h4 class="ao-item-name">' + esc(it.name) + '</h4>' +
          '<small>' + it.qty + ' x ' + idr(it.unit) + '/hari</small>' +
          (i === 0 ? '<small class="note">Please recheck the size before send to me :)</small>' : '') +
        '</div>' +
        '<span class="ao-pill ' + ui.cls + '">' + ui.label + '</span>' +
      '</div>';
    }).join('');

    $('aoSub').textContent = idr(sub);
    $('aoVoucher').textContent = disc ? idr(disc) : 'IDR -';
    $('aoTotal').textContent = idr(sub - disc);
    $('aoPrice').value = idr(sub - disc);
  }

  $('aoName').textContent = o.items[0].name;
  $('aoId').value = id;
  $('aoDate').value = o.date;
  $('aoMethod').value = o.method;
  $('aoCustomer').value = localStorage.getItem('customerName') || 'Aprilia Alfa Gusasti';
  $('aoAddress').value = localStorage.getItem('customerAddress') || 'Tangerang, Banten';
  $('aoCode').textContent = VOUCHER.code;
  $('aoStatus').value = status;
  render();

  // Edit status
  var toastEl = $('aoToast'), toastTimer;
  $('aoStatus').addEventListener('change', function(){
    status = this.value;
    saved[id] = status;
    try { localStorage.setItem('orderStatuses', JSON.stringify(saved)); } catch(e) {}
    render();
    toastEl.textContent = 'Status ' + id + ' updated to ' + status;
    toastEl.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function(){ toastEl.classList.remove('show'); }, 2000);
  });
</script>

</body>
</html>