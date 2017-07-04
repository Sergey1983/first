							  
							  



		  <option value="">Выберите город</option>	  
		  <option value="Оренбург" 
		  		<?php if ( (isset($tour->сity_from)) && ($tour->сity_from == 'Оренбург') ): ?> selected = "selected" <?php endif; ?>
		  >Оренбург</option>
		  <option value="Москва">
		  		<?php if ( (isset($tour->сity_from)) && ($tour->сity_from == 'Москва') ): ?> selected = "selected" <?php endif; ?>
		  Москва</option>
		  <option value="Минск">
		  		<?php if ( (isset($tour->сity_from)) && ($tour->сity_from == 'Минск') ): ?> selected = "selected" <?php endif; ?>
		  Минск</option>
		  <option value="Актобе"
				<?php if ( (isset($tour->сity_from)) && ($tour->сity_from == 'Актобе') ): ?> selected = "selected" <?php endif; ?>
		  >Актобе</option>