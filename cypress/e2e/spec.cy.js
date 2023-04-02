describe('chocoblast', () => {
  it('Test connexion', () => {
    cy.visit('localhost/projet/connexion')
    cy.get('body > section > form > input[type=submit]:nth-child(5)').type('mathieu.test.com')
  })
})