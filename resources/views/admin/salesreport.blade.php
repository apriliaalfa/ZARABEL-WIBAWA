<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Zarabel — Sales Reports</title>

<link rel="icon" type="image/png" href="{{ asset('assets/img/zarabelbg.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/zarabelbg.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700&family=Inter:wght@400;600;700&family=Lato:wght@400;500;700&family=Montserrat:wght@400;700&family=Nunito+Sans:wght@400;600;800&family=Playfair+Display:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Volkhov:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-search" viewBox="0 0 30 30"><path d="M26.25 26.25L20.8125 20.8125M23.75 13.75C23.75 19.2728 19.2728 23.75 13.75 23.75C8.22715 23.75 3.75 19.2728 3.75 13.75C3.75 8.22715 8.22715 3.75 13.75 3.75C19.2728 3.75 23.75 8.22715 23.75 13.75Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-cart" viewBox="0 0 35 35"><path d="M3.28125 4.375H5.30204C6.04533 4.375 6.69576 4.8747 6.88727 5.59289L7.4461 7.68847M10.9375 20.7812C8.52125 20.7812 6.5625 22.74 6.5625 25.1562H29.5312M10.9375 20.7812H27.2975C28.9324 17.4262 30.3592 13.9509 31.5609 10.3724C24.6167 8.599 17.3403 7.65625 9.84375 7.65625C9.04197 7.65625 8.24271 7.66704 7.4461 7.68847M10.9375 20.7812L7.4461 7.68847M8.75 29.5312C8.75 30.1353 8.26031 30.625 7.65625 30.625C7.05219 30.625 6.5625 30.1353 6.5625 29.5312C6.5625 28.9272 7.05219 28.4375 7.65625 28.4375C8.26031 28.4375 8.75 28.9272 8.75 29.5312ZM27.3438 29.5312C27.3438 30.1353 26.8541 30.625 26.25 30.625C25.6459 30.625 25.1562 30.1353 25.1562 29.5312C25.1562 28.9272 25.6459 28.4375 26.25 28.4375C26.8541 28.4375 27.3438 28.9272 27.3438 29.5312Z" fill="none" stroke="currentColor" stroke-width="2.33" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-user" viewBox="0 0 35 35"><path d="M22.9687 8.75C22.9687 11.7703 20.5203 14.2188 17.5 14.2188C14.4797 14.2188 12.0312 11.7703 12.0312 8.75C12.0312 5.72969 14.4797 3.28125 17.5 3.28125C20.5203 3.28125 22.9687 5.72969 22.9687 8.75ZM6.56415 29.3391C6.66668 23.3871 11.5236 18.5938 17.5 18.5938C23.4766 18.5938 28.3335 23.3874 28.4358 29.3395C25.1068 30.8671 21.4031 31.7188 17.5005 31.7188C13.5975 31.7188 9.89346 30.867 6.56415 29.3391Z" fill="none" stroke="currentColor" stroke-width="2.33" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-chev" viewBox="0 0 20 20"><path d="M16.25 6.875L10 13.125L3.75 6.875" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>

  <!-- ikon cart -->
  <symbol id="i-plus" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M12 3.75C12.4142 3.75 12.75 4.08579 12.75 4.5V11.25H19.5C19.9142 11.25 20.25 11.5858 20.25 12C20.25 12.4142 19.9142 12.75 19.5 12.75H12.75V19.5C12.75 19.9142 12.4142 20.25 12 20.25C11.5858 20.25 11.25 19.9142 11.25 19.5V12.75H4.5C4.08579 12.75 3.75 12.4142 3.75 12C3.75 11.5858 4.08579 11.25 4.5 11.25H11.25V4.5C11.25 4.08579 11.5858 3.75 12 3.75Z"/></symbol>
  <symbol id="i-minus" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M4.8 12C4.8 11.5029 5.20294 11.1 5.7 11.1L18.3 11.1C18.7971 11.1 19.2 11.5029 19.2 12C19.2 12.4971 18.7971 12.9 18.3 12.9L5.7 12.9C5.20294 12.9 4.8 12.4971 4.8 12Z"/></symbol>
  <symbol id="i-trash" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M14.7404 9L14.3942 18M9.60577 18L9.25962 9M4.77235 5.79057C5.91878 5.61744 7.07849 5.48485 8.25 5.39432C9.48744 5.2987 10.738 5.25 12 5.25C13.262 5.25 14.5126 5.2987 15.75 5.39432C16.9215 5.48485 18.0812 5.61744 19.2276 5.79057C19.5696 5.84221 19.9104 5.89747 20.25 5.95629M19.2276 5.79057L18.1598 19.6726C18.0696 20.8448 17.0921 21.75 15.9164 21.75H8.08357C6.90786 21.75 5.93037 20.8448 5.8402 19.6726L4.77235 5.79057M3.75 5.95629C4.08957 5.89747 4.43037 5.84221 4.77235 5.79057M15.75 5.39432V4.47819C15.75 3.29882 14.8393 2.31423 13.6606 2.27652C13.1092 2.25889 12.5556 2.25 12 2.25C11.4444 2.25 10.8908 2.25889 10.3394 2.27652C9.16065 2.31423 8.25 3.29882 8.25 4.47819V5.39432"/></symbol>
  <symbol id="i-x" viewBox="0 0 20 20"><path fill="currentColor" d="M6.28033 5.21967C5.98744 4.92678 5.51256 4.92678 5.21967 5.21967C4.92678 5.51256 4.92678 5.98744 5.21967 6.28033L8.93934 10L5.21967 13.7197C4.92678 14.0126 4.92678 14.4874 5.21967 14.7803C5.51256 15.0732 5.98744 15.0732 6.28033 14.7803L10 11.0607L13.7197 14.7803C14.0126 15.0732 14.4874 15.0732 14.7803 14.7803C15.0732 14.4874 15.0732 14.0126 14.7803 13.7197L11.0607 10L14.7803 6.28033C15.0732 5.98744 15.0732 5.51256 14.7803 5.21967C14.4874 4.92678 14.0126 4.92678 13.7197 5.21967L10 8.93934L6.28033 5.21967Z"/></symbol>

  <!-- ikon sosial (footer) -->
  <symbol id="i-ig" viewBox="0 0 48 48"><path fill="currentColor" d="M23.9999 15.6666C26.264 15.6666 26.5465 15.6749 27.4349 15.7166C28.3224 15.7583 28.9265 15.8974 29.4582 16.1041C30.0082 16.3158 30.4715 16.6024 30.9349 17.0649C31.3586 17.4815 31.6865 17.9854 31.8957 18.5416C32.1015 19.0724 32.2415 19.6774 32.2832 20.5649C32.3224 21.4533 32.3332 21.7358 32.3332 23.9999C32.3332 26.2641 32.3249 26.5466 32.2832 27.4349C32.2415 28.3224 32.1015 28.9266 31.8957 29.4583C31.6871 30.0147 31.3591 30.5188 30.9349 30.9349C30.5182 31.3585 30.0143 31.6864 29.4582 31.8958C28.9274 32.1016 28.3224 32.2416 27.4349 32.2833C26.5465 32.3224 26.264 32.3333 23.9999 32.3333C21.7357 32.3333 21.4532 32.3249 20.5649 32.2833C19.6774 32.2416 19.0732 32.1016 18.5415 31.8958C17.9851 31.687 17.4811 31.359 17.0649 30.9349C16.641 30.5184 16.3131 30.0145 16.104 29.4583C15.8974 28.9274 15.7582 28.3224 15.7165 27.4349C15.6774 26.5466 15.6665 26.2641 15.6665 23.9999C15.6665 21.7358 15.6749 21.4533 15.7165 20.5649C15.7582 19.6766 15.8974 19.0733 16.104 18.5416C16.3126 17.9851 16.6405 17.481 17.0649 17.0649C17.4813 16.6409 17.9852 16.313 18.5415 16.1041C19.0732 15.8974 19.6765 15.7583 20.5649 15.7166C21.4532 15.6774 21.7357 15.6666 23.9999 15.6666ZM23.9999 19.8333C22.8948 19.8333 21.835 20.2722 21.0536 21.0536C20.2722 21.835 19.8332 22.8949 19.8332 23.9999C19.8332 25.105 20.2722 26.1648 21.0536 26.9462C21.835 27.7276 22.8948 28.1666 23.9999 28.1666C25.1049 28.1666 26.1647 27.7276 26.9461 26.9462C27.7276 26.1648 28.1665 25.105 28.1665 23.9999C28.1665 22.8949 27.7276 21.835 26.9461 21.0536C26.1647 20.2722 25.1049 19.8333 23.9999 19.8333ZM29.4165 19.6249C29.4165 19.3487 29.3068 19.0837 29.1114 18.8884C28.9161 18.693 28.6511 18.5833 28.3749 18.5833C28.0986 18.5833 27.8337 18.693 27.6383 18.8884C27.443 19.0837 27.3332 19.3487 27.3332 19.6249C27.3332 19.9012 27.443 20.1661 27.6383 20.3615C27.8337 20.5568 28.0986 20.6666 28.3749 20.6666C28.6511 20.6666 28.9161 20.5568 29.1114 20.3615C29.3068 20.1661 29.4165 19.9012 29.4165 19.6249ZM23.9999 21.4999C24.6629 21.4999 25.2988 21.7633 25.7676 22.2322C26.2365 22.701 26.4999 23.3369 26.4999 23.9999C26.4999 24.663 26.2365 25.2988 25.7676 25.7677C25.2988 26.2365 24.6629 26.4999 23.9999 26.4999C23.3368 26.4999 22.7009 26.2365 22.2321 25.7677C21.7633 25.2988 21.4999 24.663 21.4999 23.9999C21.4999 23.3369 21.7633 22.701 22.2321 22.2322C22.7009 21.7633 23.3368 21.4999 23.9999 21.4999Z"/></symbol>
  <symbol id="i-call" viewBox="0 0 48 48"><path d="M26.5417 18.1667C27.3556 18.3255 28.1037 18.7235 28.6901 19.3099C29.2765 19.8963 29.6745 20.6444 29.8333 21.4583M26.5417 14.8333C28.2327 15.0212 29.8097 15.7785 31.0135 16.9808C32.2174 18.1832 32.9767 19.7592 33.1667 21.45M32.3333 28.1V30.6C32.3343 30.8321 32.2867 31.0618 32.1938 31.2745C32.1008 31.4871 31.9644 31.678 31.7934 31.8349C31.6224 31.9918 31.4205 32.1112 31.2006 32.1856C30.9808 32.2599 30.7478 32.2876 30.5167 32.2667C27.9524 31.988 25.4892 31.1118 23.325 29.7083C21.3115 28.4289 19.6044 26.7218 18.325 24.7083C16.9166 22.5343 16.0402 20.0592 15.7667 17.4833C15.7458 17.2529 15.7732 17.0206 15.8471 16.8014C15.9209 16.5821 16.0396 16.3806 16.1956 16.2097C16.3516 16.0388 16.5415 15.9023 16.7532 15.8088C16.9648 15.7153 17.1936 15.6669 17.425 15.6667H19.925C20.3294 15.6627 20.7215 15.8059 21.0281 16.0696C21.3348 16.3333 21.5351 16.6995 21.5917 17.1C21.6972 17.9001 21.8929 18.6856 22.175 19.4417C22.2871 19.7399 22.3114 20.0641 22.2449 20.3757C22.1785 20.6874 22.0241 20.9734 21.8 21.2L20.7417 22.2583C21.928 24.3446 23.6554 26.072 25.7417 27.2583L26.8 26.2C27.0266 25.9759 27.3126 25.8215 27.6243 25.7551C27.9359 25.6886 28.2601 25.7129 28.5583 25.825C29.3144 26.1071 30.0999 26.3028 30.9 26.4083C31.3048 26.4654 31.6745 26.6693 31.9388 26.9812C32.2031 27.2932 32.3435 27.6913 32.3333 28.1Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-mail" viewBox="0 0 48 48"><path fill="currentColor" d="M16 32C15.45 32 14.9792 31.8042 14.5875 31.4125C14.1958 31.0208 14 30.55 14 30V18C14 17.45 14.1958 16.9792 14.5875 16.5875C14.9792 16.1958 15.45 16 16 16H32C32.55 16 33.0208 16.1958 33.4125 16.5875C33.8042 16.9792 34 17.45 34 18V30C34 30.55 33.8042 31.0208 33.4125 31.4125C33.0208 31.8042 32.55 32 32 32H16ZM24 25L16 20V30H32V20L24 25ZM24 23L32 18H16L24 23Z"/></symbol>
  <symbol id="i-bag" viewBox="0 0 48 48"><path d="M33 18V32C33 32.5304 32.7893 33.0391 32.4142 33.4142C32.0391 33.7893 31.5304 34 31 34H17C16.4696 34 15.9609 33.7893 15.5858 33.4142C15.2107 33.0391 15 32.5304 15 32V18L18 14H30L33 18ZM15 18H33M28 22C28 23.0609 27.5786 24.0783 26.8284 24.8284C26.0783 25.5786 25.0609 26 24 26C22.9391 26 21.9217 25.5786 21.1716 24.8284C20.4214 24.0783 20 23.0609 20 22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></symbol>
  <symbol id="i-globe" viewBox="0 0 48 48"><path fill="currentColor" d="M24 34C22.6333 34 21.3417 33.7375 20.125 33.2125C18.9083 32.6875 17.8458 31.9708 16.9375 31.0625C16.0292 30.1542 15.3125 29.0917 14.7875 27.875C14.2625 26.6583 14 25.3667 14 24C14 22.6167 14.2625 21.3208 14.7875 20.1125C15.3125 18.9042 16.0292 17.8458 16.9375 16.9375C17.8458 16.0292 18.9083 15.3125 20.125 14.7875C21.3417 14.2625 22.6333 14 24 14C25.3833 14 26.6792 14.2625 27.8875 14.7875C29.0958 15.3125 30.1542 16.0292 31.0625 16.9375C31.9708 17.8458 32.6875 18.9042 33.2125 20.1125C33.7375 21.3208 34 22.6167 34 24C34 25.3667 33.7375 26.6583 33.2125 27.875C32.6875 29.0917 31.9708 30.1542 31.0625 31.0625C30.1542 31.9708 29.0958 32.6875 27.8875 33.2125C26.6792 33.7375 25.3833 34 24 34ZM24 31.95C24.4333 31.35 24.8083 30.725 25.125 30.075C25.4417 29.425 25.7 28.7333 25.9 28H22.1C22.3 28.7333 22.5583 29.425 22.875 30.075C23.1917 30.725 23.5667 31.35 24 31.95ZM21.4 31.55C21.1 31 20.8375 30.4292 20.6125 29.8375C20.3875 29.2458 20.2 28.6333 20.05 28H17.1C17.5833 28.8333 18.1875 29.5583 18.9125 30.175C19.6375 30.7917 20.4667 31.25 21.4 31.55ZM26.6 31.55C27.5333 31.25 28.3625 30.7917 29.0875 30.175C29.8125 29.5583 30.4167 28.8333 30.9 28H27.95C27.8 28.6333 27.6125 29.2458 27.3875 29.8375C27.1625 30.4292 26.9 31 26.6 31.55ZM16.25 26H19.65C19.6 25.6667 19.5625 25.3375 19.5375 25.0125C19.5125 24.6875 19.5 24.35 19.5 24C19.5 23.65 19.5125 23.3125 19.5375 22.9875C19.5625 22.6625 19.6 22.3333 19.65 22H16.25C16.1667 22.3333 16.1042 22.6625 16.0625 22.9875C16.0208 23.3125 16 23.65 16 24C16 24.35 16.0208 24.6875 16.0625 25.0125C16.1042 25.3375 16.1667 25.6667 16.25 26ZM21.65 26H26.35C26.4 25.6667 26.4375 25.3375 26.4625 25.0125C26.4875 24.6875 26.5 24.35 26.5 24C26.5 23.65 26.4875 23.3125 26.4625 22.9875C26.4375 22.6625 26.4 22.3333 26.35 22H21.65C21.6 22.3333 21.5625 22.6625 21.5375 22.9875C21.5125 23.3125 21.5 23.65 21.5 24C21.5 24.35 21.5125 24.6875 21.5375 25.0125C21.5625 25.3375 21.6 25.6667 21.65 26ZM28.35 26H31.75C31.8333 25.6667 31.8958 25.3375 31.9375 25.0125C31.9792 24.6875 32 24.35 32 24C32 23.65 31.9792 23.3125 31.9375 22.9875C31.8958 22.6625 31.8333 22.3333 31.75 22H28.35C28.4 22.3333 28.4375 22.6625 28.4625 22.9875C28.4875 23.3125 28.5 23.65 28.5 24C28.5 24.35 28.4875 24.6875 28.4625 25.0125C28.4375 25.3375 28.4 25.6667 28.35 26ZM27.95 20H30.9C30.4167 19.1667 29.8125 18.4417 29.0875 17.825C28.3625 17.2083 27.5333 16.75 26.6 16.45C26.9 17 27.1625 17.5708 27.3875 18.1625C27.6125 18.7542 27.8 19.3667 27.95 20ZM22.1 20H25.9C25.7 19.2667 25.4417 18.575 25.125 17.925C24.8083 17.275 24.4333 16.65 24 16.05C23.5667 16.65 23.1917 17.275 22.875 17.925C22.5583 18.575 22.3 19.2667 22.1 20ZM17.1 20H20.05C20.2 19.3667 20.3875 18.7542 20.6125 18.1625C20.8375 17.5708 21.1 17 21.4 16.45C20.4667 16.75 19.6375 17.2083 18.9125 17.825C18.1875 18.4417 17.5833 19.1667 17.1 20Z"/></symbol>

  <!-- ikon admin -->
<symbol id="i-ad-grid" viewBox="0 0 25 25"><g fill="none" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"><path d="M4.16667 3.125H9.375C9.9503 3.125 10.4167 3.59137 10.4167 4.16667V11.4583C10.4167 12.0336 9.9503 12.5 9.375 12.5H4.16667C3.59137 12.5 3.125 12.0336 3.125 11.4583V4.16667C3.125 3.59137 3.59137 3.125 4.16667 3.125Z"/><path d="M15.6237 3.125H20.832C21.4073 3.125 21.8737 3.59137 21.8737 4.16667V7.29167C21.8737 7.86696 21.4073 8.33333 20.832 8.33333H15.6237C15.0484 8.33333 14.582 7.86696 14.582 7.29167V4.16667C14.582 3.59137 15.0484 3.125 15.6237 3.125Z"/><path d="M15.6237 12.5H20.832C21.4073 12.5 21.8737 12.9664 21.8737 13.5417V20.8333C21.8737 21.4086 21.4073 21.875 20.832 21.875H15.6237C15.0484 21.875 14.582 21.4086 14.582 20.8333V13.5417C14.582 12.9664 15.0484 12.5 15.6237 12.5Z"/><path d="M4.16667 16.6666H9.375C9.9503 16.6666 10.4167 17.133 10.4167 17.7083V20.8333C10.4167 21.4086 9.9503 21.875 9.375 21.875H4.16667C3.59137 21.875 3.125 21.4086 3.125 20.8333V17.7083C3.125 17.133 3.59137 16.6666 4.16667 16.6666Z"/></g></symbol>

<symbol id="i-ad-card" viewBox="0 0 26 26"><g fill="currentColor" stroke="none"><path d="M22.9608 7.16342V6.80775C22.9608 5.17274 21.6306 3.84253 19.9956 3.84253H2.96522C1.33016 3.84258 0 5.17274 0 6.80775V7.16342H22.9608Z"/><path d="M13.5651 16.7017C13.5651 15.1636 14.0598 13.7017 14.9731 12.4968H0V16.6331C0 18.2681 1.33016 19.5983 2.96522 19.5983H14.1911C13.7813 18.7007 13.5651 17.7179 13.5651 16.7017ZM11.4804 15.803H8.92125V14.2796H11.4804V15.803ZM3.41545 14.2796H7.39781V15.803H3.41545V14.2796Z"/><path d="M16.5547 10.9734C17.7165 10.1606 19.0967 9.72262 20.5443 9.72262C21.3822 9.72262 22.1973 9.86974 22.9608 10.1509V8.68689H0V10.9734H16.5547Z"/><path d="M26.0013 16.7018C26.0013 13.6887 23.5587 11.2461 20.5456 11.2461C17.5325 11.2461 15.0898 13.6887 15.0898 16.7018C15.0898 19.7149 17.5324 22.1575 20.5456 22.1575C23.5587 22.1575 26.0013 19.7149 26.0013 16.7018ZM21.281 19.6164V20.2364H20.5193H19.7576V19.6209C19.297 19.465 18.9202 19.1906 18.5523 18.9215L19.4516 17.6919C19.946 18.0534 20.1989 18.2272 20.5456 18.2272C20.7416 18.2272 20.9003 18.1339 20.9598 17.9838C21.0318 17.802 20.93 17.6345 20.6874 17.5357C20.6874 17.5357 19.5986 17.1726 19.0952 16.6593C18.6729 16.2288 18.5385 15.622 18.673 15.0447C18.8083 14.4635 19.2008 14.0091 19.7576 13.7822V13.1671H21.281V13.7567C21.6679 13.8641 21.9954 14.0229 22.1837 14.1251L21.4568 15.464C20.9749 15.2024 20.5316 15.1239 20.3591 15.1829C20.1916 15.2401 20.1662 15.3493 20.1566 15.3904C20.143 15.4486 20.1358 15.538 20.2289 15.6418C20.3185 15.7417 21.2618 16.1248 21.2618 16.1248C22.2796 16.5391 22.7585 17.5795 22.376 18.5449C22.1773 19.0467 21.7774 19.4267 21.281 19.6164Z"/></g></symbol>

<symbol id="i-ad-truck" viewBox="0 0 30 30"><g fill="currentColor" stroke="none"><path d="M4.21875 5.625C2.92433 5.625 1.875 6.67433 1.875 7.96875V16.875H16.875V7.96875C16.875 6.67433 15.8257 5.625 14.5312 5.625H4.21875Z"/><path d="M16.875 18.75H1.875V22.0312C1.875 23.3257 2.92433 24.375 4.21875 24.375H4.6875C4.6875 22.3039 6.36643 20.625 8.4375 20.625C10.5086 20.625 12.1875 22.3039 12.1875 24.375H15.9375C16.4553 24.375 16.875 23.9553 16.875 23.4375V18.75Z"/><path d="M10.3125 24.375C10.3125 23.3395 9.47303 22.5 8.4375 22.5C7.40197 22.5 6.5625 23.3395 6.5625 24.375C6.5625 25.4105 7.40197 26.25 8.4375 26.25C9.47303 26.25 10.3125 25.4105 10.3125 24.375Z"/><path d="M19.6875 8.4375C19.1697 8.4375 18.75 8.85723 18.75 9.375V23.4375C18.75 23.546 18.7684 23.6502 18.8023 23.7471C19.1011 21.975 20.6429 20.625 22.5 20.625C24.5552 20.625 26.2243 22.2783 26.2497 24.3275C27.3164 24.1087 28.153 23.1583 28.08 21.9743C27.7888 17.2488 26.0969 12.9013 23.4155 9.34362C22.9725 8.75578 22.2832 8.4375 21.5776 8.4375H19.6875Z"/><path d="M24.375 24.375C24.375 23.3395 23.5355 22.5 22.5 22.5C21.4645 22.5 20.625 23.3395 20.625 24.375C20.625 25.4105 21.4645 26.25 22.5 26.25C23.5355 26.25 24.375 25.4105 24.375 24.375Z"/></g></symbol>

<symbol id="i-ad-store" viewBox="0 0 25 25"><g fill="currentColor" stroke="none"><path d="M3.92074 10.2272H1.1367C0.509043 10.2272 0 10.7362 0 11.3639V23.8639C0 24.491 0.509043 25 1.1367 25H3.92074C4.5484 25 5.05692 24.491 5.05692 23.8639V11.3639C5.05692 10.7362 4.5484 10.2272 3.92074 10.2272Z"/><path d="M10.5692 13.6356H7.78514C7.15695 13.6356 6.64844 14.1447 6.64844 14.7723V23.8627C6.64844 24.4909 7.15695 24.9994 7.78514 24.9994H10.5692C11.1968 24.9994 11.7054 24.4904 11.7054 23.8627V14.7723C11.7054 14.1447 11.1968 13.6356 10.5692 13.6356Z"/><path d="M17.2171 13.6356H14.433C13.8054 13.6356 13.2969 14.1447 13.2969 14.7723V23.8627C13.2969 24.4909 13.8054 24.9994 14.433 24.9994H17.2171C17.8453 24.9994 18.3538 24.4904 18.3538 23.8627V14.7723C18.3538 14.1447 17.8453 13.6356 17.2171 13.6356Z"/><path d="M23.8616 10.2272H21.0776C20.4499 10.2272 19.9414 10.7362 19.9414 11.3639V23.8639C19.9414 24.4915 20.4499 25 21.0776 25H23.8616C24.4893 25 24.9983 24.4905 24.9983 23.8639V11.3639C24.9983 10.7362 24.4893 10.2272 23.8616 10.2272Z"/><path d="M12.832 6.8457V8.89145C13.4512 8.85049 14.1038 8.56007 14.1038 7.87868C14.1038 7.17549 13.3884 6.96964 12.832 6.8457Z"/><path d="M11.0508 4.39732C11.0508 4.91434 11.4354 5.21328 12.2104 5.3686V3.51807C11.5061 3.53881 11.0508 3.95264 11.0508 4.39732Z"/><path d="M12.5 0C9.05372 0 6.25 2.80426 6.25 6.25C6.25 9.69468 9.05372 12.4989 12.5 12.4989C15.9463 12.4989 18.75 9.69468 18.75 6.25C18.75 2.80426 15.9463 0 12.5 0ZM12.8314 9.94628V10.5862C12.8314 10.7622 12.6963 10.9378 12.5197 10.9378C12.3452 10.9378 12.2117 10.7622 12.2117 10.5862V9.94628C10.4654 9.90372 9.59681 8.86011 9.59681 8.04362C9.59681 7.63138 9.84628 7.39309 10.2367 7.39309C11.3941 7.39309 10.4941 8.81915 12.2117 8.89096V6.73138C10.6798 6.45319 9.75213 5.78138 9.75213 4.63457C9.75213 3.22979 10.9202 2.50532 12.2117 2.46489V1.91383C12.2117 1.73777 12.3452 1.56223 12.5197 1.56223C12.6963 1.56223 12.8314 1.73777 12.8314 1.91383V2.46489C13.6367 2.48617 15.2904 2.99149 15.2904 4.00479C15.2904 4.40745 14.9894 4.64468 14.6378 4.64468C13.9654 4.64468 13.975 3.53989 12.8314 3.51862V5.48191C14.1952 5.77181 15.4032 6.17447 15.4032 7.76596C15.4032 9.15 14.3702 9.85213 12.8314 9.94628Z"/></g></symbol>

<symbol id="i-ad-user" viewBox="0 0 25 25"><g fill="currentColor" stroke="none"><path d="M12.3223 12.0426C13.9767 12.0426 15.4093 11.4492 16.5799 10.2785C17.7504 9.10793 18.3438 7.67571 18.3438 6.02109C18.3438 4.36705 17.7504 2.93463 16.5797 1.76372C15.4089 0.593374 13.9765 0 12.3223 0C10.6677 0 9.23543 0.593374 8.06489 1.76391C6.89435 2.93444 6.30078 4.36686 6.30078 6.02109C6.30078 7.67571 6.89435 9.10813 8.06508 10.2787C9.23581 11.449 10.6682 12.0426 12.3223 12.0426Z"/><path d="M22.8579 19.2237C22.8241 18.7366 22.7558 18.2052 22.6553 17.644C22.5538 17.0787 22.4232 16.5443 22.2668 16.0558C22.1052 15.5509 21.8855 15.0523 21.6139 14.5745C21.332 14.0786 21.0009 13.6468 20.6293 13.2915C20.2408 12.9197 19.7651 12.6209 19.215 12.4028C18.6668 12.186 18.0593 12.0761 17.4095 12.0761C17.1543 12.0761 16.9075 12.1808 16.4309 12.4912C16.1375 12.6825 15.7944 12.9037 15.4114 13.1484C15.0839 13.3571 14.6402 13.5526 14.0923 13.7296C13.5576 13.9026 13.0148 13.9903 12.479 13.9903C11.9432 13.9903 11.4006 13.9026 10.8654 13.7296C10.318 13.5528 9.87434 13.3573 9.54723 13.1486C9.16786 12.9062 8.82454 12.6849 8.5268 12.491C8.05073 12.1806 7.80373 12.0759 7.54852 12.0759C6.8985 12.0759 6.2912 12.186 5.74322 12.403C5.19352 12.6207 4.71764 12.9195 4.32873 13.2917C3.95737 13.6472 3.62606 14.0788 3.34454 14.5745C3.07312 15.0523 2.85339 15.5507 2.69165 16.056C2.53544 16.5444 2.40479 17.0787 2.30331 17.644C2.2028 18.2044 2.13451 18.736 2.10075 19.2243C2.06757 19.7026 2.05078 20.1991 2.05078 20.7005C2.05078 22.0055 2.46563 23.062 3.28369 23.8412C4.09164 24.61 5.16071 25.0001 6.46076 25.0001H18.4984C19.7985 25.0001 20.8672 24.6102 21.6753 23.8412C22.4936 23.0626 22.9084 22.0059 22.9084 20.7003C22.9082 20.1966 22.8912 19.6998 22.8579 19.2237Z"/></g></symbol>
  <symbol id="i-logout" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4M16 8l4 4-4 4M20 12H9"/></g></symbol>
    <symbol id="i-medal-1" viewBox="0 0 30 30"><g fill="none" stroke="#EAB308" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.01183 18.75L3.32434 8.925C3.07909 8.50109 2.96375 8.01449 2.99264 7.5256C3.02152 7.03671 3.19337 6.56708 3.48683 6.175L5.49934 3.5C5.7322 3.18951 6.03416 2.9375 6.3813 2.76393C6.72844 2.59036 7.11122 2.5 7.49934 2.5H22.4993C22.8874 2.5 23.2702 2.59036 23.6174 2.76393C23.9645 2.9375 24.2665 3.18951 24.4993 3.5L26.4993 6.175C26.7947 6.56581 26.9688 7.03481 26.9999 7.52371C27.031 8.01262 26.9178 8.49989 26.6743 8.925L20.9868 18.75"/><path d="M13.7484 15L6.39844 2.75"/><path d="M16.25 15L23.6 2.75"/><path d="M10 8.75H20"/><path d="M21.25 21.25C21.25 24.7018 18.4518 27.5 15 27.5C11.5482 27.5 8.75 24.7018 8.75 21.25C8.75 17.7982 11.5482 15 15 15C18.4518 15 21.25 17.7982 21.25 21.25Z"/><path d="M15 22.5V20H14.375"/></g></symbol>
<symbol id="i-medal-2" viewBox="0 0 30 30"><g fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.01183 18.75L3.32434 8.925C3.07909 8.50109 2.96375 8.01449 2.99264 7.5256C3.02152 7.03671 3.19337 6.56708 3.48683 6.175L5.49934 3.5C5.7322 3.18951 6.03416 2.9375 6.3813 2.76393C6.72844 2.59036 7.11122 2.5 7.49934 2.5H22.4993C22.8874 2.5 23.2702 2.59036 23.6174 2.76393C23.9645 2.9375 24.2665 3.18951 24.4993 3.5L26.4993 6.175C26.7947 6.56581 26.9688 7.03481 26.9999 7.52371C27.031 8.01262 26.9178 8.49989 26.6743 8.925L20.9868 18.75"/><path d="M13.7484 15L6.39844 2.75"/><path d="M16.25 15L23.6 2.75"/><path d="M10 8.75H20"/><path d="M21.25 21.25C21.25 24.7018 18.4518 27.5 15 27.5C11.5482 27.5 8.75 24.7018 8.75 21.25C8.75 17.7982 11.5482 15 15 15C18.4518 15 21.25 17.7982 21.25 21.25Z"/><path d="M15 22.5V20H14.375"/></g></symbol>
<symbol id="i-medal-3" viewBox="0 0 30 30"><g fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.01183 18.75L3.32434 8.925C3.07909 8.50109 2.96375 8.01449 2.99264 7.5256C3.02152 7.03671 3.19337 6.56708 3.48683 6.175L5.49934 3.5C5.7322 3.18951 6.03416 2.9375 6.3813 2.76393C6.72844 2.59036 7.11122 2.5 7.49934 2.5H22.4993C22.8874 2.5 23.2702 2.59036 23.6174 2.76393C23.9645 2.9375 24.2665 3.18951 24.4993 3.5L26.4993 6.175C26.7947 6.56581 26.9688 7.03481 26.9999 7.52371C27.031 8.01262 26.9178 8.49989 26.6743 8.925L20.9868 18.75"/><path d="M13.7484 15L6.39844 2.75"/><path d="M16.25 15L23.6 2.75"/><path d="M10 8.75H20"/><path d="M21.25 21.25C21.25 24.7018 18.4518 27.5 15 27.5C11.5482 27.5 8.75 24.7018 8.75 21.25C8.75 17.7982 11.5482 15 15 15C18.4518 15 21.25 17.7982 21.25 21.25Z"/><path d="M15 22.5V20H14.375"/></g></symbol>
  <symbol id="i-st-sales" viewBox="0 0 40 40"><g fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M10 3.3h14l7 7v23.4H10z"/><path d="M24 3.3v7h7M15 20h10M15 26h10"/></g></symbol>
  <symbol id="i-st-order" viewBox="0 0 40 40"><g stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M10 3.33337L5 10V33.3334C5 34.2174 5.35119 35.0653 5.97631 35.6904C6.60143 36.3155 7.44928 36.6667 8.33333 36.6667H31.6667C32.5507 36.6667 33.3986 36.3155 34.0237 35.6904C34.6488 35.0653 35 34.2174 35 33.3334V10L30 3.33337H10Z"/><path d="M5 10H35"/><path d="M26.6654 16.6666C26.6654 18.4347 25.963 20.1304 24.7127 21.3807C23.4625 22.6309 21.7668 23.3333 19.9987 23.3333C18.2306 23.3333 16.5349 22.6309 15.2847 21.3807C14.0344 20.1304 13.332 18.4347 13.332 16.6666"/></g></symbol>
  <symbol id="i-st-sold" viewBox="0 0 40 40"><g stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M36.3337 16.6666C37.0949 20.4021 36.5524 24.2857 34.7968 27.6696C33.0412 31.0536 30.1785 33.7334 26.6862 35.2622C23.1939 36.791 19.2831 37.0763 15.6059 36.0706C11.9287 35.0649 8.70735 32.829 6.47916 29.7357C4.25097 26.6424 3.15057 22.8787 3.36147 19.0723C3.57238 15.2659 5.08183 11.6468 7.63812 8.8186C10.1944 5.9904 13.643 4.12403 17.4088 3.53074C21.1746 2.93744 25.03 3.65308 28.332 5.55832"/><path d="M15 18.3333L20 23.3333L36.6667 6.66663"/></g></symbol>
  <symbol id="i-st-cust" viewBox="0 0 40 40"><g stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M26.6654 35V31.6667C26.6654 29.8986 25.963 28.2029 24.7127 26.9526C23.4625 25.7024 21.7668 25 19.9987 25H9.9987C8.23059 25 6.5349 25.7024 5.28465 26.9526C4.03441 28.2029 3.33203 29.8986 3.33203 31.6667V35"/><path d="M21.6654 11.6667C21.6654 15.3486 18.6806 18.3333 14.9987 18.3333C11.3168 18.3333 8.33203 15.3486 8.33203 11.6667C8.33203 7.98477 11.3168 5 14.9987 5C18.6806 5 21.6654 7.98477 21.6654 11.6667Z"/><path d="M36.668 35V31.6667C36.6669 30.1896 36.1752 28.7546 35.2702 27.5872C34.3653 26.4198 33.0982 25.586 31.668 25.2167"/><path d="M26.668 5.21667C28.102 5.58384 29.373 6.41784 30.2807 7.58719C31.1884 8.75654 31.681 10.1947 31.681 11.675C31.681 13.1553 31.1884 14.5935 30.2807 15.7628C29.373 16.9322 28.102 17.7662 26.668 18.1333"/></g></symbol>

  <!-- ikon sales report -->
  <symbol id="i-dollar" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 6H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></g></symbol>
  <symbol id="i-s-cart" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/></g></symbol>
  <symbol id="i-s-target" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></g></symbol>
  <symbol id="i-trend-up" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 7l-8.5 8.5-5-5L2 17M16 7h6v6"/></g></symbol>
  <symbol id="i-trend-down" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17l-8.5-8.5-5 5L2 7M16 17h6v-6"/></g></symbol>
  <symbol id="i-cal2" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></g></symbol>
  <symbol id="i-download" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></g></symbol>
  <symbol id="i-chip" viewBox="0 0 35 35"><g fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><rect x="3" y="6" width="29" height="23" rx="4"/><path d="M3 15h10M22 15h10M3 21h10M22 21h10M13 6v23M22 6v23"/></g></symbol>
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

  <!-- ================= ISI DASHBOARD ================= -->
  <section class="ad-content">
    <h1 class="ad-title">Sales Reports</h1>

    <div class="sr-filters">
      <span class="sr-chip"><svg class="ic"><use href="#i-cal2"/></svg>Jan1 - Dec 31, 2024</span>
      <span class="sr-chip">Compare: Last Year</span>
      <button type="button" class="sr-export" id="exportBtn"><svg class="ic"><use href="#i-download"/></svg>Export Report</button>
    </div>

    <div class="sr-stats">
      <div class="sr-stat">
        <div><div class="lbl">Total Revenue</div><div class="val">IDR {{ number_format($totalRevenue, 0, ',', '.') }}</div><div class="chg" style="--k:#36D399"><svg class="ic"><use href="#i-trend-up"/></svg>+18.2%</div></div>
        <div class="ico" style="--c:#36D399"><svg class="ic"><use href="#i-dollar"/></svg></div>
      </div>
      <div class="sr-stat">
        <div><div class="lbl">Total Orders</div><div class="val">{{ number_format($totalOrders, 0, ',', '.') }}</div><div class="chg" style="--k:#36D399"><svg class="ic"><use href="#i-trend-up"/></svg>+12.5%</div></div>
        <div class="ico" style="--c:#3C83F6"><svg class="ic"><use href="#i-s-cart"/></svg></div>
      </div>
      <div class="sr-stat">
        <div><div class="lbl">New Customers</div><div class="val">{{ number_format($newCustomers, 0, ',', '.') }}</div><div class="chg" style="--k:#36D399"><svg class="ic"><use href="#i-trend-up"/></svg>+8.1%</div></div>
        <div class="ico" style="--c:#7C3BED"><svg class="ic"><use href="#i-st-cust"/></svg></div>
      </div>
      <div class="sr-stat">
        <div><div class="lbl">Conversion Rate</div><div class="val">3.24%</div><div class="chg" style="--k:#EF4343"><svg class="ic"><use href="#i-trend-down"/></svg>-2.4%</div></div>
        <div class="ico" style="--c:#F67655"><svg class="ic"><use href="#i-s-target"/></svg></div>
      </div>
    </div>

    <div class="ad-block">
      <h3 class="ad-h">Financial Wallet</h3>
      <div class="sr-wallets">

        <div class="wcard">
          <div class="top"><div class="lbl">Saldo</div><div class="bal">Rp {{ number_format($bankTotal ?? 0, 0, ',', '.') }}</div></div>
          <svg class="chip"><use href="#i-chip"/></svg>
          <div class="info">
            <div><small>CARD HOLDER</small><b>ZARABEL</b></div>
            <div><small>PAYMENT METHOD</small><b>BANK TRANSFER</b></div>
          </div>
          <div class="foot"><span>0978 5634 21196</span><span class="circles"><i></i><i></i></span></div>
        </div>

        <div class="wcard">
          <div class="top"><div class="lbl">Saldo</div><div class="bal">Rp {{ number_format($ewalletTotal ?? 0, 0, ',', '.') }}</div></div>
          <svg class="chip"><use href="#i-chip"/></svg>
          <div class="info">
            <div><small>CARD HOLDER</small><b>ZARABEL</b></div>
            <div><small>PAYMENT METHOD</small><b>E-WALLET</b></div>
          </div>
          <div class="foot"><span>0858 4619 7216</span><span class="circles"><i></i><i></i></span></div>
        </div>

        <div class="wcard qris">
          <div class="top"><div class="lbl">Total Transaction Seluruh User</div><div class="bal">Rp {{ number_format($qrisTotal ?? 0, 0, ',', '.') }}</div></div>
          <div class="qr"><img src="{{ asset('assets/img/qris kode.webp') }}" alt="QRIS"></div>
          <div class="info">
            <div><small>CARD HOLDER</small><b>ZARABEL</b></div>
            <div><small>PAYMENT METHOD</small><b>QRIS</b></div>
          </div>
        </div>

      </div>
    </div>

    <div class="ad-block">
      <h3 class="ad-h">Top Selling Products</h3>
      <div class="tbl-wrap">
        <div class="tbl tbl-products">
          <div class="tr th"><span>Rank</span><span>ID</span><span>Product Name</span><span>Category</span><span>Revenue</span><span>Units Sold</span><span>Popularity</span><span>Sale</span></div>
        @php
          $colors = ['#463ACB', '#36D399', '#7C3BED', '#F67655', '#EBF655', '#F18AA0'];
          $maxSold = isset($topProducts) && $topProducts->count() ? ($topProducts->max('units_sold') ?: 1) : 1;
        @endphp
        @forelse($topProducts ?? [] as $index => $tp)
        @php
          $c = $colors[$index % count($colors)];
          $pct = min(100, max(5, round(($tp->units_sold / $maxSold) * 100)));
          $tpImg = $tp->product_image ? asset($tp->product_image) : asset('assets/img/cat1.jpg');
        @endphp
        <div class="tr">
          <span class="rank">
            @if($index == 0)
              <svg class="ic"><use href="#i-medal-1"/></svg>
            @elseif($index == 1)
              <svg class="ic"><use href="#i-medal-2"/></svg>
            @elseif($index == 2)
              <svg class="ic"><use href="#i-medal-3"/></svg>
            @else
              #{{ $index + 1 }}
            @endif
          </span>
          <span>{{ str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}</span>
          <div class="who"><div class="av"><img src="{{ $tpImg }}" alt=""></div><span class="nm">{{ $tp->product_name }}</span></div>
          <span>{{ $tp->product?->category_name ?? 'Collection' }}</span>
          <span class="money">IDR {{ number_format($tp->revenue, 0, ',', '.') }}</span>
          <span>{{ number_format($tp->units_sold, 0, ',', '.') }}</span>
          <div class="bar" style="--c:{{ $c }}"><i data-w="{{ $pct }}"></i></div>
          <span class="pct" style="--c:{{ $c }}">{{ $pct }}%</span>
        </div>
        @empty
        <div style="padding:20px;text-align:center;color:#888;">Belum ada data penjualan produk.</div>
        @endforelse
        </div>
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

<script>
  // Menu HP
  var nav = document.getElementById('mainNav');
  var toggle = document.getElementById('menuToggle');
  toggle.addEventListener('click', function(){
    toggle.setAttribute('aria-expanded', nav.classList.toggle('open'));
  });
  document.querySelectorAll('[data-scroll]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var el = document.getElementById(btn.dataset.scroll);
      if (el) el.scrollIntoView({ behavior:'smooth' });
    });
  });

  // Animasi bar popularity / contribution
  window.addEventListener('load', function(){
    document.querySelectorAll('.bar i').forEach(function(b){
      setTimeout(function(){ b.style.width = b.dataset.w + '%'; }, 80);
    });
  });
  // Export Report (contoh: cetak halaman ke PDF)
  var ex = document.getElementById('exportBtn');
  if (ex) ex.addEventListener('click', function(){ window.print(); });
</script>

</body>
</html>