							  
							  



		  <option value="">Выберите город</option>	  
		  <option value="Оренбург" 
		  		<?php if ( (isset($tour->city_from)) && ($tour->city_from == 'Оренбург') ): ?> selected = "selected" <?php endif; ?>
		  >Оренбург</option>
		  <option value="Москва">
		  		<?php if ( (isset($tour->city_from)) && ($tour->city_from == 'Москва') ): ?> selected = "selected" <?php endif; ?>
		  Москва</option>
		  <option value="Минск">
		  		<?php if ( (isset($tour->city_from)) && ($tour->city_from == 'Минск') ): ?> selected = "selected" <?php endif; ?>
		  Минск</option>
		  <option value="Актобе"
				<?php if ( (isset($tour->city_from)) && ($tour->city_from == 'Актобе') ): ?> selected = "selected" <?php endif; ?>
		  >Актобе</option>