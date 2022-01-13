<div class="games_menu">
    <div class="list">
        <a class="{{ Request::is('refill') ? 'activ' : '' || Request::is('refill_dynamics') ? 'activ' : ''}}" data-href="/refill_dynamics" onclick="dynamics(this);">
            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.3906 12.2111H24V7.99238H1.40625C0.891703 7.99238 0.415312 7.84346 0 7.60126V19.9455C0 21.8839 1.5772 23.4611 3.51562 23.4611H24V19.2424H20.3906C18.4522 19.2424 16.875 17.6652 16.875 15.7268C16.875 13.7883 18.4522 12.2111 20.3906 12.2111ZM11.9531 15.0236C13.1163 15.0236 14.0625 15.9699 14.0625 17.133C14.0625 18.0485 13.4729 18.8216 12.6562 19.1129V20.6486H11.25V19.1129C10.4333 18.8216 9.84375 18.0485 9.84375 17.133H11.25C11.25 17.5209 11.5652 17.8361 11.9531 17.8361C12.3411 17.8361 12.6562 17.5209 12.6562 17.133C12.6562 16.7451 12.3411 16.4299 11.9531 16.4299C10.79 16.4299 9.84375 15.4837 9.84375 14.3205C9.84375 13.405 10.4333 12.6319 11.25 12.3406V10.8049H12.6562V12.3406C13.4729 12.6319 14.0625 13.405 14.0625 14.3205H12.6562C12.6562 13.9326 12.3411 13.6174 11.9531 13.6174C11.5652 13.6174 11.25 13.9326 11.25 14.3205C11.25 14.7084 11.5652 15.0236 11.9531 15.0236Z"  />
                <path d="M20.3906 13.6174C19.2275 13.6174 18.2812 14.5636 18.2812 15.7267C18.2812 16.8899 19.2275 17.8361 20.3906 17.8361H24V13.6174H20.3906ZM21.0938 16.4299H19.6875V15.0236H21.0938V16.4299Z"  />
                <path d="M9.14053 0.538879L4.30322 6.58613H13.9778L9.14053 0.538879Z"  />
                <path d="M14.7654 0.538879L12.8535 2.92918L15.7792 6.58613H19.6027L14.7654 0.538879Z"  />
                <path d="M19.1543 3.77362L21.4044 6.58612H22.5V3.77362H19.1543Z"  />
                <path d="M1.40625 3.77362C0.629578 3.77362 0 4.4032 0 5.17987C0 5.9565 0.629578 6.58612 1.40625 6.58612H2.50181L4.75195 3.77362H1.40625Z"  />
            </svg>
            <span>Депозит</span>
        </a>
        <a class="{{ Request::is('withdrawal') ? 'activ' : '' || Request::is('withdrawal_dynamics') ? 'activ' : ''}}" data-href="/withdrawal_dynamics" onclick="dynamics(this);">
            <svg width="24" height="24" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg">
                <path d="M23.25 0.0010376H0.75C0.336 0.0010376 0 0.337037 0 0.751037V11.251C0 11.665 0.336 12.001 0.75 12.001H3.507C4.104 10.9555 4.5045 9.94453 4.7505 9.00103H4.5C3.672 9.00103 3 8.32903 3 7.50103V4.50103C3 3.67303 3.672 3.00103 4.5 3.00103H19.5C20.328 3.00103 21 3.67303 21 4.50103V7.50103C21 8.19103 20.5245 8.74603 19.8915 8.92153C19.716 9.89503 19.4265 10.9285 18.999 12.001H23.25C23.664 12.001 24 11.665 24 11.251V0.751037C24 0.337037 23.664 0.0010376 23.25 0.0010376Z"  />
                <path d="M23.25 0.0010376H0.75C0.336 0.0010376 0 0.337037 0 0.751037V11.251C0 11.665 0.336 12.001 0.75 12.001H3.507C4.104 10.9555 4.5045 9.94453 4.7505 9.00103H4.5C3.672 9.00103 3 8.32903 3 7.50103V4.50103C3 3.67303 3.672 3.00103 4.5 3.00103H19.5C20.328 3.00103 21 3.67303 21 4.50103V7.50103C21 8.19103 20.5245 8.74603 19.8915 8.92153C19.716 9.89503 19.4265 10.9285 18.999 12.001H23.25C23.664 12.001 24 11.665 24 11.251V0.751037C24 0.337037 23.664 0.0010376 23.25 0.0010376Z"  />
                <path d="M18.5325 4.50073H6.52053C6.78603 6.45073 6.72153 9.64573 4.61103 13.1092C0.76653 19.4152 3.00453 23.4532 3.10053 23.6227C3.23403 23.8552 3.48303 23.9992 3.75153 23.9992H14.2515C14.517 23.9992 14.7615 23.8552 14.8965 23.6272C15.0315 23.3992 15.0345 23.1127 14.9055 22.8802C14.8275 22.7407 13.0425 19.3882 16.392 13.8907C18.6735 10.1482 18.807 6.71773 18.5325 4.50073ZM9.00003 6.75073C9.00003 6.33673 9.33603 6.00073 9.75003 6.00073C10.164 6.00073 10.5 6.33673 10.5 6.75073V8.25073C10.5 8.66473 10.164 9.00073 9.75003 9.00073C9.33603 9.00073 9.00003 8.66473 9.00003 8.25073V6.75073ZM12 20.2507C12 20.6647 11.664 21.0007 11.25 21.0007C10.836 21.0007 10.5 20.6647 10.5 20.2507V18.7507C10.5 18.3367 10.836 18.0007 11.25 18.0007C11.664 18.0007 12 18.3367 12 18.7507V20.2507ZM10.5 16.1257C9.25953 16.1257 8.25003 14.9482 8.25003 13.5007C8.25003 12.0532 9.25953 10.8757 10.5 10.8757C11.7405 10.8757 12.75 12.0532 12.75 13.5007C12.75 14.9482 11.7405 16.1257 10.5 16.1257Z"  />
                <path d="M18.5325 4.50073H6.52053C6.78603 6.45073 6.72153 9.64573 4.61103 13.1092C0.76653 19.4152 3.00453 23.4532 3.10053 23.6227C3.23403 23.8552 3.48303 23.9992 3.75153 23.9992H14.2515C14.517 23.9992 14.7615 23.8552 14.8965 23.6272C15.0315 23.3992 15.0345 23.1127 14.9055 22.8802C14.8275 22.7407 13.0425 19.3882 16.392 13.8907C18.6735 10.1482 18.807 6.71773 18.5325 4.50073ZM9.00003 6.75073C9.00003 6.33673 9.33603 6.00073 9.75003 6.00073C10.164 6.00073 10.5 6.33673 10.5 6.75073V8.25073C10.5 8.66473 10.164 9.00073 9.75003 9.00073C9.33603 9.00073 9.00003 8.66473 9.00003 8.25073V6.75073ZM12 20.2507C12 20.6647 11.664 21.0007 11.25 21.0007C10.836 21.0007 10.5 20.6647 10.5 20.2507V18.7507C10.5 18.3367 10.836 18.0007 11.25 18.0007C11.664 18.0007 12 18.3367 12 18.7507V20.2507ZM10.5 16.1257C9.25953 16.1257 8.25003 14.9482 8.25003 13.5007C8.25003 12.0532 9.25953 10.8757 10.5 10.8757C11.7405 10.8757 12.75 12.0532 12.75 13.5007C12.75 14.9482 11.7405 16.1257 10.5 16.1257Z"  />
                <path d="M18.5325 4.50073H6.52053C6.78603 6.45073 6.72153 9.64573 4.61103 13.1092C0.76653 19.4152 3.00453 23.4532 3.10053 23.6227C3.23403 23.8552 3.48303 23.9992 3.75153 23.9992H14.2515C14.517 23.9992 14.7615 23.8552 14.8965 23.6272C15.0315 23.3992 15.0345 23.1127 14.9055 22.8802C14.8275 22.7407 13.0425 19.3882 16.392 13.8907C18.6735 10.1482 18.807 6.71773 18.5325 4.50073ZM9.00003 6.75073C9.00003 6.33673 9.33603 6.00073 9.75003 6.00073C10.164 6.00073 10.5 6.33673 10.5 6.75073V8.25073C10.5 8.66473 10.164 9.00073 9.75003 9.00073C9.33603 9.00073 9.00003 8.66473 9.00003 8.25073V6.75073ZM12 20.2507C12 20.6647 11.664 21.0007 11.25 21.0007C10.836 21.0007 10.5 20.6647 10.5 20.2507V18.7507C10.5 18.3367 10.836 18.0007 11.25 18.0007C11.664 18.0007 12 18.3367 12 18.7507V20.2507ZM10.5 16.1257C9.25953 16.1257 8.25003 14.9482 8.25003 13.5007C8.25003 12.0532 9.25953 10.8757 10.5 10.8757C11.7405 10.8757 12.75 12.0532 12.75 13.5007C12.75 14.9482 11.7405 16.1257 10.5 16.1257Z"  />
                <defs>
                    <linearGradient id="paint0_linear" x1="1.33" y1="6.00103" x2="24" y2="6.00103" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#D66CFF" />
                        <stop offset="0.864583" stop-color="#5887FF" />
                    </linearGradient>
                    <linearGradient id="paint1_linear" x1="3.26783" y1="14.25" x2="18.636" y2="14.25" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#D66CFF" />
                        <stop offset="0.864583" stop-color="#5887FF" />
                    </linearGradient>
                    <linearGradient id="paint2_linear" x1="3.26783" y1="14.25" x2="18.636" y2="14.25" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#D66CFF" />
                        <stop offset="0.864583" stop-color="#5887FF" />
                    </linearGradient>
                </defs>
            </svg>
            <span>Выплата</span>
        </a>
        <a href="#">
            <svg width="24" height="22" viewBox="0 0 24 22" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.7086 0.714294C8.02286 0.714294 3.42857 5.31999 3.42857 11H0L4.45141 15.4514L4.53139 15.6171L9.14288 11H5.7143C5.7143 6.58288 9.29716 3.00003 13.7143 3.00003C18.1314 3.00003 21.7143 6.58288 21.7143 11C21.7143 15.4171 18.1314 19 13.7143 19C11.5029 19 9.50855 18.0972 8.06288 16.6514L6.44571 18.2686C8.30288 20.1314 10.8686 21.2857 13.7086 21.2857C19.3943 21.2857 24 16.68 24 11C24 5.31999 19.3943 0.714294 13.7086 0.714294Z"></path>
                <path d="M12.5715 6.42859V12.1428L17.4629 15.0457L18.2858 13.6571L14.2858 11.2857V6.42859H12.5715Z"></path>
            </svg>
            <span>История</span>
        </a>
    </div>
</div>