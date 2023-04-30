<div class="delete-modal modal">
    <div class="delete-modal__container modal__container">
        <a wire:click.prevent="$emit('closeModal')" class="delete-modal__close modal__close">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.28167 0.391474C1.7597 -0.130491 0.913435 -0.130491 0.391472 0.391474C-0.130491 0.913439 -0.130491 1.75971 0.391472 2.28168L8.10981 10L0.391552 17.7183C-0.13041 18.2403 -0.130411 19.0866 0.391552 19.6085C0.913514 20.1305 1.75978 20.1305 2.28175 19.6085L10 11.8902L17.7183 19.6085C18.2402 20.1305 19.0865 20.1305 19.6084 19.6085C20.1304 19.0866 20.1304 18.2403 19.6084 17.7183L11.8902 10L19.6085 2.28168C20.1305 1.75971 20.1305 0.913439 19.6085 0.391474C19.0866 -0.130491 18.2403 -0.130491 17.7183 0.391474L10 8.10984L2.28167 0.391474Z"
                    fill="#1D1D39" />
            </svg>
        </a>
        <div class="delete-modal__content modal__content">
            <div class="delete-modal__header modal__header">
                <h2 class="delete-modal__title modal__title">Удаление</h2>
                <p class="delete-modal__subtitle modal__subtitle">Вы точно хотите произвести удаление данной группы?
                </p>
            </div>
            <div class="delete-modal__row">
                <a wire:click.prevent="$emit('closeModal')"
                    class="delete-modal__button delete-modal__no modal__button">Нет</a>
                <a href="#" class="delete-modal__button delete-modal__yes modal__button">Да</a>
            </div>
        </div>
    </div>
</div>
