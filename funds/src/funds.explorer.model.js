import { define } from 'db.js';
import { Sequelize } from 'sequelize';

const Funds = define('funds', {
    id: {
        type: Sequelize.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    consulta: {
        type: Sequelize.LONGTEXT,
        allowNull: false,
      },
    data: {
        type: Sequelize.DATE
    }
})

export default Funds;